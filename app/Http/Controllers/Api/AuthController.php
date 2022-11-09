<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Countries;
use Illuminate\Http\Request;
use Validator;
use Hash;
use DB;

use App\Models\User;

class AuthController extends BaseController
{
    /**
     * Handle an incoming login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $rules = [
            'phone_number' => ['required'],
            'password' => ['required']
        ];
        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->messages();
            return $this->sendError('Missing required fields', $errors, 401);
        } else {
            $country_code = $request->country_code;
            $phone_number = $request->phone_number;
            $password = $request->password;
            $url = url('/');
            $user = User::select(
                'id',
                'name',
                'first_name',
                'last_name',
                'email',
                'phone_number as mobile_number',
                'country_code',
                'status',
                'street',
                'house_no as housenumber',
                'zipcode',
                'city as cityname',
                'kvk_no as kvknumber',
                DB::raw("(CONCAT('$url',profile_pic)) as profilepic"),
                'phone_number_verified',
                'password',
                'user_type',
                'device_token',
                'documents_verified',
            )
                ->where('phone_number', $phone_number)->where('country_code', $country_code)->where('status', 1)->first();

            if (isset($user->id) && !$user->phone_number_verified) {
                return $this->sendError('Phone number not verified', [], 401);
            }
            if (!$user || !Hash::check($password, $user->password)) {
                return $this->sendError('Invalid login details', [], 401);
            }
        }

        // Revoke all tokens...
        $user->tokens()->delete();

        $user->device_token = $request->device_token;
        $user->save();
        $user->isCompany = ($user->user_type == 'courier') ? 1 : 0;
        $user->companyname =  ($user->isCompany) ? $user->name : '';

        $success['id'] =  $user->id;
        $success['token'] =  $user->createToken('pakket2go')->plainTextToken;
        $success['user'] =  $user;

        return $this->sendResponse($success, 'Login successfull.');
    }

    public function countries()
    {
        $countries = Countries::all();

        return $this->sendResponse($countries, 'Countries fetched successfully');
    }
}
