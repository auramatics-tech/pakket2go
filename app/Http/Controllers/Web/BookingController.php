<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\BookingStep;
use App\Models\ParcelOption;

use Session;
use Auth;
use App;


class BookingController extends Controller
{

    function __construct(Request $request)
    {
        $this->step = isset($request->step) ? $request->step : '';
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
        $booking = Booking::where(function ($query) {
            $query->where('session_id', Session::getId())
                ->orwhere('user_id', Auth::id());
        })->where('status', 0)
            ->latest()->first();

        if (!isset($booking->id) && $current_step->id != 1)
            return redirect()->route('booking', ['step' => 'address']);
        elseif (isset($booking->id) && $booking->step >= $current_step->id)
            echo "ht";

        $booking_steps = BookingStep::where('status', 1)->orderby('order', 'asc')->get();
        if ($current_step->id == 5) {
            $parcel_options['popular'] = ParcelOption::whereJsonContains('step', $current_step->id)->where('popular', 1)->get();
            $parcel_options['other'] = ParcelOption::whereJsonContains('step', $current_step->id)->where('popular', 0)->get();
        } else {
            $parcel_options = ParcelOption::whereJsonContains('step', $current_step->id)->get();
        }

        $parcel_details =  $booking->details;

        return view("web.booking.layouts.master", ['booking_steps' => $booking_steps, 'current_step' => $current_step, 'parcel_options' => $parcel_options, 'booking' => $booking, 'parcel_details' => $parcel_details]);
    }
}
