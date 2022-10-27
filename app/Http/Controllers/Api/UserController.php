<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


use Validator;

class UserController extends BaseController
{

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
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

        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->messages();
            return $this->sendError('Missing required fields', $errors, 401);
        } else {
            $profile_pic = '';
            if ($request->has('profile_pic')) {
                $uploadFolder = '/uploads/profile_pic';
                $imageName = time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(storage_path($uploadFolder), $imageName);
                $profile_pic = $uploadFolder . '/' . $imageName;
            }

            $user = User::create([
                'user_type' => $request->user_type,
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'street' => $request->street,
                'house_no' => $request->house_no,
                'kvk_no' => $request->kvk_no,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'password' => Hash::make($request->password),
                'profile_pic' => $profile_pic,
                'phone_number_verified' => 1,
                'status' => 1
            ]);

            event(new Registered($user));

            return response()->json(['status' => 1, 'message' => 'User registered successfully']);
        }
    }

    public function check_phone_number(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'phone_number' => 'required',
            'country_code' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->messages();
            return $this->sendError('Missing required fields', $errors, 200);
        }
        $phone_number =  $request->phone_number;
        $country_code =  $request->country_code;
        $user = User::where('phone_number', $phone_number)->where('country_code', $country_code)->first();
        if (!empty($user)) {
            $response['message'] = "User registered with phone number";
            $response['phone_number'] = $phone_number;
            $response['user_id'] = $user->id;
            $response['status'] = 1;
            return response()->json($response, 200);
        } else {
            $response['message'] = "Invalid mobile number";
            $response['status'] = 0;
            return response()->json($response, 200);
        }
    }
}
