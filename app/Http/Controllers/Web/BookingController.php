<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\BookingPayments;
use App\Models\BookingStep;
use App\Models\ParcelOption;
use App\Models\BookingDetails;
use App\Models\UserLocation;

use Session;
use Auth;
use App;
use Illuminate\Support\Facades\Mail;
use Log;
use DB;

use Mollie\Laravel\Facades\Mollie;

class BookingController extends Controller
{

    function __construct(Request $request)
    {
        $this->step = isset($request->step) ? $request->step : $request->segment(3);
    }

    /**
     * Booking steps
     * @param step string
     */
    public function index()
    {
        // check if step from the url is valid step
        $current_step = BookingStep::where('url_code', $this->step)->first();
        if (!isset($current_step->id))
            return redirect()->route('booking', ['step' => 'address']);
        // check if user has completed the current booking step if not redirect to step 1 or to last completed step +1
        $booking = Booking::when(
            Auth::id(),
            function ($query) {
                $query->where(function ($q) {
                    $q->where('user_id', Auth::id())->orwhere('session_id', Session::get('logged_in'));
                });
            },
            function ($query) {
                $query->where('session_id', Session::getId());
            }
        )->where('status', 1)
            ->latest()->first();

        if (isset($booking->id) && Session::has('logged_in')) {
            $booking->current_step = $current_step->id;
            $booking->user_id = Auth::id();
            $booking->save();
        }

        if (!isset($booking->id) && $current_step->id != 1) {
            return redirect()->route('booking', ['step' => 'address']);
        } elseif (isset($booking->id) && $booking->current_step > $current_step->id) {
            $skip_steps = skip_steps($booking, $current_step->id);
            if (empty($skip_steps) || !in_array($current_step->id, $skip_steps)) {
            } else {
                $booking_step = BookingStep::where('id', $booking->current_step)->first();
                return redirect()->route('booking', ['step' => $current_step->url_code]);
            }
        } elseif (isset($booking->id) && $booking->current_step < $current_step->id) {
            $booking_step = BookingStep::where('id', $booking->current_step)->first();
            return redirect()->route('booking', ['step' => $booking_step->url_code]);
        }


        $booking_steps = BookingStep::where('status', 1)->orderby('order', 'asc')->get();
        if ($current_step->id == 5) {
            $parcel_options['popular'] = ParcelOption::whereJsonContains('step', $current_step->id)->where('popular', 1)->get();
            $parcel_options['other'] = ParcelOption::whereJsonContains('step', $current_step->id)->where('popular', 0)->get();
        } else {
            $parcel_options = ParcelOption::whereJsonContains('step', $current_step->id)->get();
        }

        $parcel_details =  isset($booking->details) ? $booking->details : '';

        $payment_methods = [];
        if ($this->step == 'payment') {
            $payment_methods = Mollie::api()->methods()->allActive();
        }
        $previous_step = '';
        if ($current_step->id > 1) {
            $previous_step = BookingStep::where('id', $current_step->id - 1)->first();
            $skip_steps = skip_steps($booking, $previous_step->id);
            if (!empty($skip_steps) && in_array($previous_step->id, $skip_steps)) {
                $previous_step = BookingStep::where('id', $previous_step->id - 1)->first();
            }
        }

        return view("web.booking.layouts.master", ['booking_steps' => $booking_steps, 'current_step' => $current_step, 'previous_step' => $previous_step, 'parcel_options' => $parcel_options, 'booking' => $booking, 'parcel_details' => $parcel_details, 'payment_methods' => $payment_methods]);
    }

    public function thankyou()
    {
        return view("web.booking.thankyou");
    }

    public function payment_webhook(Request $request)
    {
        Log::channel('Payments')->info($request->all());
        try {
            $paymentId = $request->input('id');
            $booking_payment = BookingPayments::where('transaction_id', $paymentId)->first();
            $payment = Mollie::api()->payments->get($paymentId);
            if ($payment->isPaid()) {
                $booking_payment->status = 'paid';
                $booking_payment->save();

                $booking = Booking::where('payment_id', $booking_payment->id)->first();
                $booking->status = 2;
                $booking->save();

                // Mail to booking user
                Mail::send('mails.new_booking', ['booking' => $booking, 'type' => 'user'], function ($mail) use ($booking) {
                    $mail->to($booking->user->email, $booking->user->first_name . ' ' . $booking->user->last_name)
                        ->subject('New order');
                });

                // New order admin mail
                Mail::send('mails.new_booking', ['booking' => $booking, 'type' => 'admin'], function ($mail) use ($booking) {
                    $mail->to(env('ADMIN_MAIL'), 'Pakket2Go')
                        ->subject('New order received');
                });

                $this->booking_nearby_riders($booking);
            } else {
                $booking_payment->status = 'failed';
                $booking_payment->save();

                $booking = Booking::where('payment_id', $booking_payment->id)->first();
                $booking->status = 1;
                $booking->save();

                // Payment failed
                Mail::send('mails.payment_failed', ['booking' => $booking], function ($mail) use ($booking) {
                    $mail->to($booking->user->email, $booking->user->first_name . ' ' . $booking->user->last_name)
                        ->subject('Payment Failed');
                });
            }

            return response()->json(['status' => true]);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            Log::channel("Payments")->info($th->getMessage());
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }



    protected function booking_nearby_riders($booking)
    {
        $riders = UserLocation::select(
            'user_locations.created_at as track_time',
            'latitude as lat',
            'longitude as long',
            'accuracy',
            'rotation',
            'user_id',
            'first_name',
            'last_name',
            'device_token',
            DB::raw('SQRT( POW(69.1 * (`latitude` - ' . $booking->address->pickup_lat . '), 2) + POW(69.1 * (' . $booking->address->pickup_lng . ' - `longitude`) * COS(`latitude` / 57.3), 2)) AS distance')
        )
            ->leftJoin('users', 'users.id', '=', 'user_locations.user_id')
            ->where("users.user_type", "courier")
            ->whereIn('user_locations.id', function ($query) {
                $query->from('user_locations')->select(DB::raw('max(id) as id'))
                    ->groupby('user_locations.user_id');
            })
            ->whereNotNull('device_token')
            ->having('distance', '<=', '45')
            ->orderBy('distance', 'asc')
            ->get();

        if (count($riders)) {
            foreach ($riders as $rider) {
                $this->sendPushNotification($rider->device_token, 'New ready to pick up order nearby you.', 'neworder', $booking->booking_code);

                // Send new order mails
                Mail::send('mails.courier_nearby', ['booking' => $booking], function ($mail) use ($rider) {
                    $mail->to($rider->email, $rider->first_name . ' ' . $rider->last_name)
                        ->subject('New ready to pick up order nearby you');
                });
            }
        }
    }
}
