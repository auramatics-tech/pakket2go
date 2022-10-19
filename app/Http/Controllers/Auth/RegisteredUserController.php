<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // check if phone number is registered but not verified if not verified move to otp screen
        $check = User::where(['country_code' => $request->country_code, 'phone_number' => $request->phone_number, 'phone_number_verified' => 0])->count();
        if ($check) {
            session(['country_code' => $request->country_code, 'phone_number' => $request->phone_number]);
            return redirect()->route('otp')->with('phone_number', $request->country_code . $request->phone_number);
        }
        if (isset($request->user_type) && $request->user_type == 'private') {
            $rules =  [
                'user_type' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'country_code' => ['required'],
                'phone_number' => ['required', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ];
        } else {
            $rules = [
                'user_type' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'country_code' => ['required'],
                'phone_number' => ['required', 'unique:users'],
                'street' => ['required'],
                'house_no' => ['required'],
                'house_no_extension' => ['required'],
                'kvk_no' => ['required'],
                'city' => ['required'],
                'zipcode' => ['required'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ];
        }

        $request->validate($rules);

        $user = User::create([
            'user_type' => $request->user_type,
            'name' => $request->name,
            'first_name' => isset($request->first_name) ?? $request->first_name,
            'last_name' => isset($request->first_name) ?? $request->last_name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone_number' => $request->phone_number,
            'street' => isset($request->first_name) ?? $request->street,
            'house_no' => isset($request->first_name) ?? $request->house_no,
            'house_no_extension' => isset($request->first_name) ?? $request->house_no_extension,
            'city' => isset($request->first_name) ?? $request->city,
            'zipcode' => isset($request->first_name) ?? $request->zipcode,
            'password' => Hash::make($request->password),
            'email_verified_at' => date("Y-m-d H:i:s")
        ]);

        event(new Registered($user));

        return redirect()->route('otp')->with('phone_number', $request->country_code . $request->phone_number);
    }
}
