<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\BookingPayments;
use App\Models\BookingStep;
use App\Models\ParcelOption;
use App\Models\BookingDetails;

use Session;
use Auth;
use App;
use Log;

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
            if (empty($skip_steps) || in_array($current_step->id, $skip_steps)) {
                $booking_step = BookingStep::where('id', $booking->current_step)->first();
                return redirect()->route('booking', ['step' => $booking_step->url_code]);
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
        Log::info($request->all());
        $paymentId = $request->input('id');
        $booking_payment = BookingPayments::where('transaction_id', $paymentId)->first();
        $payment = Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid()) {
            $booking_payment->status = 'paid';
            $booking_payment->save();

            $booking = Booking::where('payment_id', $booking_payment->id)->first();
            $booking->status = 1;
            $booking->save();
        }
    }
}
