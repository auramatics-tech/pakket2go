<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;

use Auth;
use Pdf;

class UserController extends Controller
{

    public function dashboard()
    {
        $bookings = Booking::where("user_id", Auth::id())->latest()->get();

        return view('web.user.dashboard', ['bookings' => $bookings]);
    }

    public function booking_details(Request $request)
    {
        $booking = Booking::where("user_id", Auth::id())->where("booking_code", $request->id)->first();

        if (!isset($booking->id))
            return redirect()->route("dashboard")->with('error', 'Invalid booking code');

        $booking_details =  isset($booking->details) ? $booking->details : '';

        return view('web.user.order_detail', ['booking' => $booking, 'booking_details' => $booking_details]);
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
