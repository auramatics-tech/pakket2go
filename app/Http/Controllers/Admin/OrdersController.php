<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingStatus;
use Illuminate\Http\Request;

use Auth;


class OrdersController extends Controller
{

    public function orders(Request $request)
    {

        $booking_status = BookingStatus::when($request->status, function ($query) use ($request) {
            $query->where('status_type', $request->status);
        })->pluck('id')->first();

        $orders = Booking::when($request->status, function ($query) use ($booking_status) {
            $query->where('status', $booking_status);
        })->get();

        echo "<pre>";
        print_r($orders); die;

        return view('admin.dashboard', compact('booking_status'));
    }
}
