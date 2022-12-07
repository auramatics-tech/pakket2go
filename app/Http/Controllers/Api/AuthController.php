<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Countries;
use Illuminate\Http\Request;
use Validator;
use Hash;
use DB;

use App\Models\User;
use App\Http\Traits\NotificationTrait;

class AuthController extends BaseController
{
    use NotificationTrait;
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
            return $this->sendError('Missing required fields', $errors, 403);
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
                return $this->sendError('Phone number not verified', [], 403);
            }
            if (!$user || !Hash::check($password, $user->password)) {
                return $this->sendError('Invalid login details', [], 403);
            }
        }
        $user->device_token = $request->device_token;
        $user->save();
        // Revoke all tokens...
        $user->tokens()->delete();


        // $this->sendPushNotification($user->device_token, 'You received new message', 'chat', 1);

        $user->isCompany = ($user->user_type == 'courier') ? 1 : 0;
        $user->companyname =  ($user->isCompany) ? $user->name : '';

        $success['id'] =  $user->id;
        $success['token'] =  $user->createToken('pakket2go')->plainTextToken;
        $success['user'] =  $this->user_data($user);

        return $this->sendResponse($success, 'Login successfull.');
    }
    protected function user_data($user)
    {
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
            'phone_number_verified',
            'password',
            'user_type',
            'device_token',
            'documents_verified',
            DB::raw("(CONCAT('$url',front_driving_license)) as front_driving_license"),
            DB::raw("(CONCAT('$url',back_driving_license)) as back_driving_license"),
            DB::raw("(CONCAT('$url',chamber_of_commerce)) as chamber_of_commerce"),
            DB::raw("(CONCAT('$url',profile_pic)) as profilepic")
        )
            ->find($user->id);

        $user->isCompany = ($user->user_type != 'courier') ? 1 : 0;
        $user->companyname =  ($user->isCompany) ? $user->name : '';
        $user->documents_verified  = ($user->documents_verified == 1) ? 1 : 0 ;
        $user->documentsUploaded = ($user->front_driving_license && $user->back_driving_license) ? 1 : 0;
        return $user;
    }
    public function countries()
    {
        $countries = Countries::all();

        return $this->sendResponse($countries, 'Countries fetched successfully');
    }
}
