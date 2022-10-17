<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Countries;
use Illuminate\Http\Request;
use Validator;
use Hash;

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
            $phone_number = $request->phone_number;
            $password = $request->password;

            $user = User::where('phone_number', $phone_number)->first();
            if (!$user || !Hash::check($password, $user->password)) {
                return $this->sendError('Invalid login details', [], 401);
            }
        }

        // Revoke all tokens...
        // $user->tokens()->delete();

        $success['id'] =  $user->id;
        $success['token'] =  $user->createToken('questmath')->plainTextToken;
        $success['data'] =  $user;

        return $this->sendResponse($success, 'Tutor login successfully.');
    }

    public function countries()
    {
        $countries = Countries::all();

        return $this->sendResponse($countries, 'Countries fetched successfully');
    }
}
