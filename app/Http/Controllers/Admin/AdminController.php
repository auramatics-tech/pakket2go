<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;


class AdminController extends Controller
{

    public function login()
    {
        return view('admin.login');
    }

    public function check_login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email,  'password' => $request->password, 'user_type' => 'admin'])) {
            return redirect()->route('admin.dashboard')->with('success', 'You are Logged in sucessfully.');
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
    }
}
