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

use Session;

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
        // echo "<pre>";
        // print_r($request->all());
        // die;

        // check if phone number is registered but not verified if not verified move to otp screen
        $check = User::where(['country_code' => $request->country_code, 'phone_number' => $request->phone_number, 'phone_number_verified' => 0])->first();
        if (isset($check->id)) {
            // update user
            $user = User::where('id', $check->id)->update($this->user_data($request));
            $check->otp_sent_at = '';
            $check->save();

            Auth::login($check);

            return redirect()->route('otp');
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

        $user = User::create($this->user_data($request));

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('otp')->with('phone_number', $request->country_code . $request->phone_number);
    }

    public function update_otp(Request $request)
    {
        $user = User::find($request->id);
        $user->otp_sent_at = $request->date;
        $user->otp_result = $request->otp_result;
        $user->save();

        return response()->json(['status' => 1]);
    }

    protected function user_data($request)
    {
        $data = [
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
        ];

        return $data;
    }

    public function verify_otp(Request $request)
    {
        $user = User::find($request->id);
        $user->phone_number_verified = 1;
        $user->save();

        return response()->json(['status' => 1]);
    }

    public function kvkautocomplete(Request $request)
    {
        $res =  'autocomplete success';
        $searchkeyword   = $request->get('searchval');
        $apiURL = env('KVK_API') . "zoeken?handelsnaam='$searchkeyword'";

        $resarr = [];

        $client = new \GuzzleHttp\Client(['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'apikey' => 'l7xxc7eedf88b2864ab9b29bdfcbfc1156e5']]);
        $response = $client->request('GET', $apiURL);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            $responseBody = ['msg' => 'Error'];
            $resarr[$responseBody];
        } else {
            $responseBody = json_decode($response->getBody(), true);
            $totalcount = count($responseBody['resultaten']);
            if ($totalcount > 0) {
                foreach ($responseBody['resultaten'] as $resb) {
                    $resarr[] = $resb;
                }
            } else {
                $responseBody = ['msg' => 'Empty'];
                $resarr[$responseBody];
            }
        }

        return response()->json($resarr);
    }

    public function kvkbasicprofile(Request $request)
    {
        $res =  'autocomplete success';
        $kvknumberis   = $request->get('kvknumberis');
        $apiURL = env('KVK_API') . "basisprofielen/" . $kvknumberis;

        $resarr = [];

        $client = new \GuzzleHttp\Client(['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'apikey' => 'l7xxc7eedf88b2864ab9b29bdfcbfc1156e5']]);
        $response = $client->request('GET', $apiURL);

        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) {
            $responseBody = ['msg' => 'Error'];
            $resarr[$responseBody];
        } else {
            $responseBody = json_decode($response->getBody(), true);
            $totalcount = count($responseBody['_embedded']);
            if ($totalcount > 0) {
                $resarr[] = $responseBody['_embedded']['hoofdvestiging']['adressen'];
            } else {
                $responseBody = ['msg' => 'Empty'];
                $resarr[$responseBody];
            }
        }

        return response()->json($resarr);
    }
}
