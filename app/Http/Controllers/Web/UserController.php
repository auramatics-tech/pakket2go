<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;

use Auth;


class UserController extends Controller
{

    public function dashboard()
    {
        $bookings = Booking::where("user_id", Auth::id())->get();

        return view('web.user.dashboard', ['bookings' => $bookings]);
    }
}
