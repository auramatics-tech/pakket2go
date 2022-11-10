<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Booking;

use Auth;
use Pdf;
use DB;

class UserController extends Controller
{

    function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {

            $this->current_booking = Booking::where('courier_user_id', Auth::id())->where('status', '<', 5)->latest()->pluck('id')->first();

            return $next($request);
        });
    }

    public function dashboard(Request $request)
    {
        $status = ($request->status) ? $request->status : 'ready-to-pickup';
        if (Auth::user()->user_type == 'courier')
            $bookings = Booking::when(isset($request->latlong) && $request->latlong, function ($query) use ($request) {
                $latlng = explode(',', $request->latlong);

                $query->select(
                    'bookings.*',
                    DB::raw('SQRT( POW(69.1 * (`pickup_lat` - ' . $latlng[0] . '), 2) + POW(69.1 * (' . $latlng[1] . ' - `pickup_lng`) * COS(`pickup_lat` / 57.3), 2)) AS distance')
                )
                    ->join('booking_address', 'booking_address.booking_id', '=', 'bookings.id');
            }, function ($query) {
                $user = User::find(Auth::id());
                $lat = $user->last_location->latitude;
                $lng = $user->last_location->longitude;
                $query->select(
                    'bookings.*',
                    DB::raw('SQRT( POW(69.1 * (`pickup_lat` - ' . $lat . '), 2) + POW(69.1 * (' . $lng . ' - `pickup_lng`) * COS(`pickup_lat` / 57.3), 2)) AS distance')
                )
                    ->join('booking_address', 'booking_address.booking_id', '=', 'bookings.id');
            })
                ->when($status, function ($query) use ($status) {
                    $query->join('booking_status', 'booking_status.id', '=', 'bookings.status')
                        ->where(function ($q)  use ($status) {
                            $q->where('booking_status.status_type', $status)->orwhere("booking_status.status", $status);
                        });
                })
                ->whereNotIn('bookings.id', function ($query) {
                    $query->select('booking_id')
                        ->from("courier_canceled_bookings")
                        ->where('user_id', Auth::id());
                })
                ->having("distance", "<=", 45)
                ->whereNull("courier_user_id")
                ->get();
        else
            $bookings = Booking::where("user_id", Auth::id())->latest()->get();

        return view('web.user.bookings', ['bookings' => $bookings, 'current_booking' => $this->current_booking]);
    }

    public function my_deliveries()
    {
        $bookings = Booking::where("courier_user_id", Auth::id())->latest()->get();
        $total_earnings = Booking::where("courier_user_id", Auth::id())->where('status', 5)->sum('courier_price');
        return view('web.user.bookings', ['bookings' => $bookings, 'total_earnings' => $total_earnings, 'current_booking' => $this->current_booking]);
    }

    public function booking_details(Request $request)
    {
        $booking = Booking::where("user_id", Auth::id())->where("booking_code", $request->id)->first();

        if (!isset($booking->id))
            return redirect()->route("dashboard")->with('error', 'Invalid booking code');

        $booking_details =  isset($booking->details) ? $booking->details : '';

        return view('web.user.order_detail', ['booking' => $booking, 'booking_details' => $booking_details, 'current_booking' => $this->current_booking]);
    }

    public function booking_invoice(Request $request)
    {
        $booking = Booking::where("user_id", Auth::id())->where("booking_code", $request->id)->first();

        if (!isset($booking->id))
            return redirect()->route("dashboard")->with('error', 'Invalid booking code');

        $booking_details =  isset($booking->details) ? $booking->details : '';

        $pdf = Pdf::loadView('web.user.invoice', ['booking' => $booking, 'booking_details' => $booking_details]);
        return $pdf->download("$booking->booking_code.pdf");
    }
}
