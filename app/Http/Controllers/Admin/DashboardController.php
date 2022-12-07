<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingStatus;
use Illuminate\Http\Request;

use Auth;


class DashboardController extends Controller
{

    public function index()
    {
        $booking_status = BookingStatus::all();
        return view('admin.dashboard', compact('booking_status'));
    }
}
