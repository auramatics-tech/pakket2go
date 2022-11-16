<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Booking;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Traits\BookingTrait;
use App\Models\Enquiry;
use App\Models\UserLocation;
use File;
use Image;
use Validator;
use DB;

class UserController extends BaseController
{

    use BookingTrait;
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

        $rules = $this->rules($request->user_type);

        if ($request->password) {
            $rules = array_merge($rules, ['user_type' => ['required']]);
        }

        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->errors();
            return $this->sendError($errors->first(), [], 200);
        } else {

            $user = $this->save_user_data($request);
            event(new Registered($user));
            Auth::login($user);

            // Revoke all tokens...
            $user->tokens()->delete();
            $success['id'] =  $user->id;
            $success['token'] =  $user->createToken('pakket2go')->plainTextToken;
            $success['user'] =  $user;

            return $this->sendResponse($success, 'User registered successfully');
        }
    }

    public function check_phone_number(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'phone_number' => 'required',
            'country_code' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), [], 200);
        }
        $phone_number =  $request->phone_number;
        $country_code =  $request->country_code;
        $user = User::where('phone_number', $phone_number)->where('country_code', $country_code)->first();
        if (!empty($user)) {
            $response['message'] = "User registered with phone number";
            $response['user_type'] = $user->user_type;
            $response['isCompany'] = ($user->user_type != 'courier') ? 1 : 0;
            $response['phone_number'] = $phone_number;
            $response['user_id'] = $user->id;
            $response['status'] = true;
            return response()->json($response, 200);
        } else {
            $response['message'] = "Invalid mobile number";
            $response['status'] = false;
            return response()->json($response, 200);
        }
    }

    public function update_profile(Request $request)
    {
        $user_type = Auth::user()->user_type;

        $rules = $this->rules($user_type);

        if ($request->password) {
            $rules = array_merge($rules, ['password' => ['required', 'confirmed', Rules\Password::defaults()]]);
        }

        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->errors();
            return $this->sendError($errors->first(), [], 200);
        } else {

            $user = $this->save_user_data($request);
            $success['id'] =  $user->id;
            $success['user'] =  $user;

            return $this->sendResponse($success, 'User updated successfully');
        }
    }

    public function my_bookings(Request $request)
    {
        $bookings = Booking::select('bookings.*')->where(function ($query) {
            $query->where('user_id', Auth::id())->orwhere('courier_user_id', Auth::id());
        })
            ->when(isset($request->type) && $request->type, function ($query) use ($request) {
                $types = array_map('strtolower', explode(',', $request->type));
                $query->join('booking_status', 'booking_status.id', '=', 'bookings.status')
                    ->whereIn('booking_status.status_type', $types);
            })
            ->get();
        if (count($bookings)) {
            foreach ($bookings as $key => $booking) {
                $bookings[$key]->invoice_url = url('booking-invoice/' . $booking->id);
                $this->booking_data($booking);
            }
        }
        return $this->sendResponse($bookings, 'Bookings fetched successfully');
    }

    public function booking_details(Request $request)
    {
        $booking = Booking::where('user_id', Auth::id())->where("id", $request->booking_id)->first();
        if (isset($booking->id)) {
            $this->booking_data($booking);
            return $this->sendResponse($booking, 'Booking details successfully');
        } else {
            return $this->sendResponse([], 'Booking not found');
        }
    }

    public function cancel_booking(Request $request)
    {
        $booking = Booking::where('user_id', Auth::id())->where("id", $request->booking_id)->first();
        if (isset($booking->id)) {
            $booking->status = $request->status;
            $booking->save();

            // refund in case of payment done
            if ($booking->payment_id && $booking->payment_status->status == 'paid') {
                // will do later
            }

            $booking_data = $this->booking_data($booking);

            return response()->json(['status' => true, 'message' => 'Booking canceled successfully', 'booking' => $booking_data]);
        }


        return response()->json(['status' => true, 'message' => 'Booking not found']);
    }

    protected function rules($user_type)
    {
        if ($user_type == 'private') {
            $rules =  [
                'name' => ['required', 'string', 'max:255'],
                'country_code' => ['required']
            ];
        } else {
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'country_code' => ['required'],
                'street' => ['required'],
                'house_no' => ['required'],
                'house_no_extension' => ['required'],
                'kvk_no' => ['required'],
                'city' => ['required'],
                'zipcode' => ['required']
            ];
        }
        if (Auth::id()) {
            $rules = array_merge($rules, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
                'phone_number' => ['required', 'unique:users,phone_number,' . Auth::id()]
            ]);
        } else {
            $rules = array_merge($rules, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'unique:users']
            ]);
        }

        return $rules;
    }

    public function update_password(Request $request)
    {
        $rules = [
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];

        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->errors();
            return $this->sendError($errors->first(), [], 200);
        } else {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->sendResponse($this->user_data($user), 'Password updated successfully');
        }
    }

    public function reset_password(Request $request)
    {
        $rules = [
            'user_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];

        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->errors();
            return $this->sendError($errors->first(), [], 200);
        } else {
            $user = User::find($request->user_id);
            if (!isset($user->id)) {
                return $this->sendError('User not found', [], 200);
            }
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->sendResponse($this->user_data($user), 'Password reseted successfully');
        }
    }

    public function contact_us(Request $request)
    {

        $rules = [
            'name' => ['required'],
            'phone' => ['required'],
            'message' => ['required'],
        ];

        $credentials = Validator::make($request->all(), $rules);

        if ($credentials->fails()) {
            $errors = $credentials->errors();
            return $this->sendError($errors->first(), [], 200);
        } else {
            $enquiry = new Enquiry();
            $enquiry->user_id = (Auth::id()) ? Auth::id()  : '';
            $enquiry->name = $request->name;
            $enquiry->subject = 'Enquiry from app';
            $enquiry->phone = $request->phone;
            $enquiry->message = $request->message;
            $enquiry->save();
            return $this->sendResponse($enquiry, 'Thanks!! We will contact you shortly');
        }
    }


    public function nearbyriders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => 'required',
            'long' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), [], 200);
        }

        $riders = UserLocation::select(
            'user_locations.created_at as track_time',
            'latitude as lat',
            'longitude as long',
            'accuracy',
            'rotation',
            'user_id',
            'first_name',
            'last_name',
            DB::raw('SQRT( POW(69.1 * (`latitude` - ' . $request->lat . '), 2) + POW(69.1 * (' . $request->long . ' - `longitude`) * COS(`latitude` / 57.3), 2)) AS distance')
        )
            ->leftJoin('users', 'users.id', '=', 'user_locations.user_id')
            ->where("users.user_type", "courier")
            ->whereIn('user_locations.id', function ($query) {
                $query->from('user_locations')->select(DB::raw('max(id) as id'))
                    ->groupby('user_locations.user_id');
            })
            ->orderBy('distance', 'asc')
            ->get();

        if (count($riders)) {
            return $this->sendResponse($riders, count($riders) . ' Riders found nearby');
        } else {
            return $this->sendResponse([], 'No nearby rider found');
        }
    }

    public function my_profile(){
        $user_data = Auth::user();
        $success['id'] =  $user_data->id;
        $success['user'] =  $this->user_data($user_data);

        return $this->sendResponse($success, 'My profile successfully');
    }

    protected function save_user_data($request)
    {
        $data = [
            'name' => $request->name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'phone_number' => $request->phone_number,
            'street' => $request->street,
            'house_no' => $request->house_no,
            'kvk_no' => $request->kvk_no,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'password' => Hash::make($request->password),
            'profile_pic' => $request->profile_pic,
            'phone_number_verified' => 1,
            'status' => 1
        ];
        if (Auth::id()) {
            User::where('id', Auth::id())->update($data);
            $user = Auth::user();
        } else {
            $data = array_merge($data, ['user_type' => $request->user_type]);
            $user = User::create($data);
        }

        if ($request->profile_pic) {
            $profile_pic = time() . ".png";
            $storage_path = '/storage/uploads/user/' . $user->id . '/profile_pic';
            $path = public_path($storage_path) . '/' . $profile_pic;
            if (!File::exists($path)) {
                File::makeDirectory($path . 'original', 0775, true, true);
            }
            Image::make(file_get_contents($request->profile_pic))->save($path);
            $user->profile_pic = $storage_path . '/' . $profile_pic;
            $user->save();
        }

        return $this->user_data($user);
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
}
