<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\User;
use App\Models\Booking;
use App\Models\BookingPayments;
use App\Models\BookingAddress;
use App\Models\BookingStep;
use App\Models\BookingDetails;
use App\Models\ParcelOption;
use App\Models\BookingFeedback;
use App\Models\Measurement;

use App\Http\Requests\BookingRequest;
use App\Http\Traits\BookingTrait;

use Session;
use Auth;
use App;
use File;
use Image;
use Validator;
use DB;

use Mollie\Laravel\Facades\Mollie;

class BookingController extends BaseController
{

    use BookingTrait;

    function __construct(Request $request)
    {
        $this->lang = $request->lang;
    }

    public function steps()
    {
        $steps = BookingStep::where('status', 1)->orderby('order', 'asc')->get();
        if (count($steps)) {
            foreach ($steps as $step_key => $step) {
                $options = ParcelOption::whereJsonContains('step', $step->id)->get();
                if (count($options)) {
                    foreach ($options as $key => $option) {
                        $option->name = json_decode($option->name)->{$this->lang};
                        $option->description = json_decode($option->description)->{$this->lang};
                        $option->image = asset($option->image);
                        $option->skip_steps = ($option->skip_steps) ? json_decode($option->skip_steps) : [];
                        $option->step = $step_key + 1;
                    }
                }
                $parcel_options[] = $options;
            }
        }

        $url = asset('assets/svg/');
        $measurements = Measurement::select('measurements.id', 'measurements.measurement', DB::raw("(CONCAT('$url/',image)) as image"),'length','width','height')->get();

        return response()->json(['status' => true, 'message' => 'Parcel options retrieved', 'parcel_options' => $parcel_options, 'measurements' => $measurements]);
    }

    /**
     * Booking steps
     * @param step string
     */
    public function booking(BookingRequest $request)
    {
        if ($request->ajax()) {
            $user_id = $request->user_id;
            $session_id = $request->session_id;
        } else {
            $user_id = isset(auth('sanctum')->user()->id) ? auth('sanctum')->user()->id : '';
            $session_id = Session::getId();
        }

        // check if user has completed the current booking step if not redirect to step 1 or to last completed step +1
        $booking = Booking::when($request->booking_id, function ($query) use ($request) {
            $query->where('id', $request->booking_id);
        })->when(
            $user_id && !$request->booking_id,
            function ($query)  use ($user_id) {
                $query->where(function ($q) use ($user_id) {
                    $q->where('user_id', $user_id)->when(Session::get('logged_in'), function ($q1) {
                        $q1->orwhere('session_id', Session::get('logged_in'));
                    });
                });
            },
            function ($query)  use ($session_id, $request) {
                if (!$request->booking_id)
                    $query->where('session_id', $session_id);
            }
        )->where('status', 1)
            ->latest()->first();

        if (!isset($booking->id) && $request->step != 1) {
            if ($request->ajax())
                return response()->json(['success' => true, 'redirect' => route('booking.address', ['locale' => App::getLocale()]), 'step_view' => '']);
            else
                return response()->json(['success' => false, 'message' => 'Please start from step 1']);
        }

        if (!isset($booking->id)) {
            $booking = new Booking;
        }

        $skip_steps = skip_steps($booking);

        switch ($request->step) {
            case 1:
                $booking->user_id = $user_id;
                $booking->session_id = $session_id;
                $booking->save();
                $booking->address_id = $this->saveAddress($request, $booking);
                $booking->save();
                $this->parcelType($request, $booking);
                $this->calcualte_distance_price($request, $booking);
                break;
            case 2:
                $this->parcelType($request, $booking);
                break;
            case 3:
                $this->parcelDetails($request, $booking);
                if ($request->ajax()) {
                    $request->pickup_date = date("Y-m-d");
                    $request->price = 0;
                    $this->pickupDate($request, $booking);
                }
                break;
            case 4:
                $this->pickupDate($request, $booking);
                if ($request->ajax()) {
                    if ($skip_steps && !in_array(5, $skip_steps))
                        $this->pickupExtraHelp($request, $booking);
                    else
                        $this->pickupFloor($request, $booking);
                }
                break;
            case 5:
                $this->pickupExtraHelp($request, $booking);
                if ($request->ajax())
                    $this->pickupFloor($request, $booking);
                break;
            case 6:
                $this->pickupFloor($request, $booking);
                if ($request->ajax()) {
                    $request->type_id = '';
                    $this->deliveryFloor($request, $booking);
                }
                break;
            case 7:
                $this->deliveryFloor($request, $booking);
                break;
            case 9:
                if (!$request->ajax() && !isset(auth('sanctum')->user()->id)) {
                    return $this->sendError('Please login first', [], 401);
                }
                $booking->user_id = $user_id;
                $booking->address_id = $this->saveAddress($request, $booking);
                $booking->save();
                break;
            case 10:
                if (!$request->ajax() && !isset(auth('sanctum')->user()->id)) {
                    return $this->sendError('Please login first', [], 401);
                }
                $booking->user_id = $user_id;
                $booking->address_id = $this->saveAddress($request, $booking);
                $booking->save();
                if (isset(auth('sanctum')->user()->id) && auth('sanctum')->user()->user_type == 'business') {
                    $booking->status = 2;
                    $booking->save();
                    $this->booking_data($booking);
                    return $this->sendResponse($booking, 'Booking created successfully');
                }
                break;
            case 11:
                if (!$request->ajax() && !isset(auth('sanctum')->user()->id)) {
                    return $this->sendError('Please login first', [], 401);
                }

                if (isset(auth('sanctum')->user()->id) && auth('sanctum')->user()->user_type != 'business') {

                    $booking->transaction_id = $request->transaction_id;
                    $booking->transaction_status = $request->status;
                    $this->save_payment($booking);
                    $booking->status = 2;
                    $booking->save();
                    $this->booking_data($booking);
                    return $this->sendResponse($booking, 'Booking created successfully');
                } else {
                    $redirect = $this->payment($request, $booking);
                    $booking->status = 1;
                    $booking->save();
                    return response()->json(['success' => true, 'redirect' => $redirect, 'step_view' => '']);
                }
                break;
            default:
                return $this->sendError('Invalid step data', [], 401);
                break;
        }

        $price = $this->calculate_final_price($booking);
        $next_step = BookingStep::find($request->step + 1);
        if ($request->ajax()) {
            $redirect = '';
            $step_view = '';

            $skip_steps = skip_steps($booking, $next_step->id, $user_id);

            if (!empty($skip_steps) && in_array($next_step->id, $skip_steps)) {
                $next_step = BookingStep::find($next_step->id + 1);
            }
            if ($user_id) {
                $user = User::find($user_id);
            }
            if ($next_step->id == 11 && isset($user->id) && $user->user_type == 'business') {
                $booking->status = 2;
                $booking->save();
                $redirect =  route('booking.success', ['locale' => App::getLocale()]);
                return response()->json(['success' => true, 'redirect' => $redirect, 'step_view' => $step_view]);
            }

            $booking->current_step = $next_step->id;
            $booking->save();

            $redirect =  route('booking', ['step' => $next_step->url_code, 'locale' => App::getLocale()]);
            return response()->json(['success' => true, 'redirect' => $redirect, 'step_view' => $step_view]);
        } else {

            $booking->current_step = $next_step->id;
            $booking->save();
            return response()->json(['success' => true, 'booking_status' => $booking->booking_status(), 'message' => 'Booking data saved successfully', 'booking_id' => $booking->id, 'parcel_code' => $booking->booking_code, 'pricing_details' => $price, 'final_price' => round($booking->final_price, 2)]);
        }
    }

    protected function saveAddress($request, $booking)
    {
        $address = BookingAddress::find($booking->address_id);
        if (!isset($address->id)) {
            $address = new BookingAddress();
        }

        $address->booking_id = $booking->id;

        // Pickup
        $address->pickup_address = (isset($request->pickup_address) && $request->pickup_address) ? $request->pickup_address : $address->pickup_address;
        $address->pickup_postcode = (isset($request->pickup_postcode) && $request->pickup_postcode) ? $request->pickup_postcode : $address->pickup_postcode;
        $address->pickup_house_no = (isset($request->pickup_house_no) && $request->pickup_house_no) ? $request->pickup_house_no :  $address->pickup_house_no;
        $address->pickup_street = (isset($request->pickup_street) && $request->pickup_street) ? $request->pickup_street : $address->pickup_street;
        $address->pickup_locality = (isset($request->pickup_locality) && $request->pickup_locality) ? $request->pickup_locality : $address->pickup_locality;
        $address->pickup_lat = (isset($request->pickup_lat) && $request->pickup_lat) ? $request->pickup_lat : $address->pickup_lat;
        $address->pickup_lng = (isset($request->pickup_lng) && $request->pickup_lng) ? $request->pickup_lng : $address->pickup_lng;
        $address->pickup_additinal_info = (isset($request->pickup_additinal_info) && $request->pickup_additinal_info) ? $request->pickup_additinal_info : $address->pickup_additinal_info;
        $address->pickup_closing_time = (isset($request->pickup_closing_time) && $request->pickup_closing_time) ? $request->pickup_closing_time : $address->pickup_closing_time;
        $address->pickup_contact_name = (isset($request->pickup_contact_name) && $request->pickup_contact_name) ? $request->pickup_contact_name : $address->pickup_contact_name;
        $address->pickup_contact_number = (isset($request->pickup_contact_number) && $request->pickup_contact_number) ? $request->pickup_contact_number :  $address->pickup_contact_number;

        // Delivery
        $address->delivery_address = (isset($request->delivery_address) && $request->delivery_address) ? $request->delivery_address : $address->delivery_address;
        $address->delivery_postcode = (isset($request->delivery_postcode) && $request->delivery_postcode) ? $request->delivery_postcode : $address->delivery_postcode;
        $address->delivery_house_no = (isset($request->delivery_house_no) && $request->delivery_house_no) ? $request->delivery_house_no :  $address->delivery_house_no;
        $address->delivery_street = (isset($request->delivery_street) && $request->delivery_street) ? $request->delivery_street : $address->delivery_street;
        $address->delivery_locality = (isset($request->delivery_locality) && $request->delivery_locality) ? $request->delivery_locality : $address->delivery_locality;
        $address->delivery_lat = (isset($request->delivery_lat) && $request->delivery_lat) ? $request->delivery_lat : $address->delivery_lat;
        $address->delivery_lng = (isset($request->delivery_lng) && $request->delivery_lng) ? $request->delivery_lng : $address->delivery_lng;
        $address->delivery_additinal_info = (isset($request->delivery_additinal_info) && $request->delivery_additinal_info) ? $request->delivery_additinal_info : $address->delivery_additinal_info;
        $address->delivery_contact_name = (isset($request->delivery_contact_name) && $request->delivery_contact_name) ? $request->delivery_contact_name : $address->delivery_contact_name;
        $address->delivery_contact_number = (isset($request->delivery_contact_number) && $request->delivery_contact_number) ? $request->delivery_contact_number :  $address->delivery_contact_number;

        if ($request->step == 1) {
            $direction_data = $this->direction_image($request, $booking);
            $address->distance = (isset($request->distance) && $request->distance) ? $request->distance :  $direction_data['total_distance'];
            $address->direction_image = $direction_data['direction_image'];
        }
        $address->save();

        return $address->id;
    }

    protected function direction_image($request, $booking, $size = "400x400")
    {
        $origin = "$request->pickup_lat,$request->pickup_lng";
        $destination = "$request->delivery_lat,$request->delivery_lng";
        $waypoints = array(
            $origin,
            $destination
        );
        $markers = array();
        $waypoints_labels = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K");
        $waypoints_label_iter = 0;

        $from_icon = asset('/assets/img/from.png');
        $to_icon = asset('/assets/img/to.png');

        $markers[] = "markers=icon:$from_icon" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter++] . '|' . $origin);
        $markers[] = "markers=icon:$to_icon" . urlencode("|") . "label:" . urlencode($waypoints_labels[$waypoints_label_iter] . '|' . $destination);

        $routes = Http::get(env('GOOGLE_MAPS_API') . "directions/json?origin=$origin&destination=$destination&waypoints=" . implode('|', $waypoints) . "&key=" . env('GOOGLE_SITE_KEY'));

        $total_distance = 0;
        $distance = isset($routes['routes'][0]['legs']) ? $routes['routes'][0]['legs'] : array();
        if (count($distance)) {
            foreach ($distance as $travel) {
                $total_distance += $travel['distance']['value'];
            }
        }
        $data['total_distance'] = round($total_distance / 1000);

        $polyline = isset($routes['routes'][0]['overview_polyline']['points']) ? urlencode($routes['routes'][0]['overview_polyline']['points']) : '';
        $markers = implode('&', $markers);

        $styles = "style=feature:administrative|element:geometry|visibility:off&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|visibility:off&style=feature:transit|visibility:off&style=saturation:-100";

        $direction_image = env('GOOGLE_MAPS_API') . "staticmap?size=$size&maptype=roadmap&path=color:0xfc4c00|weight:5|enc:$polyline&$markers&$styles&key=" . env('GOOGLE_SITE_KEY');

        $time = time();
        $imageName = 'direction_' . $time . '.png';
        $path = public_path('/storage/uploads/bookings/' . $booking->id . '/direction') . '/' . $imageName;

        if (!File::exists($path)) {
            File::makeDirectory($path . 'original', 0775, true, true);
        }
        Image::make(file_get_contents($direction_image))->save($path);

        $data['direction_image'] = '/storage/uploads/bookings/' . $booking->id . '/direction/' . $imageName;

        return $data;
    }

    protected function parcelType($request, $booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        if (!isset($booking_details->id)) {
            $booking_details = new BookingDetails();
        }

        if (!isset($request->type_id)) {
            $parcel_options = ParcelOption::whereJsonContains('step', 2)->where(['default' => 1])->first();
        } else {
            $parcel_options = ParcelOption::find($request->type_id);
        }

        $parcel_type['id'] = $parcel_options->id;
        $parcel_type['name'] = $parcel_options->name;
        $parcel_type['description'] = $parcel_options->description;
        $parcel_type['price'] = $parcel_options->price;
        $parcel_type['quantity'] = $parcel_options->quantity;
        $parcel_type['labelRequired'] = $parcel_options->labelRequired;

        $booking_details->booking_id = $booking->id;
        $booking_details->parcel_type = json_encode($parcel_type);
        $skip_steps = json_decode($parcel_options->skip_steps);
        if (!empty($skip_steps)) {
            foreach ($skip_steps as $s_step) {
                $step_data = implode('_', explode('-', BookingStep::where('id', $s_step)->pluck("url_code")->first()));
                $booking_details->{$step_data} = json_encode([]);
            }
        }
        $booking_details->save();
        return $booking_details->id;
    }

    protected function parcelDetails($request, $booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        if (!isset($booking_details->id)) {
            $booking_details = new BookingDetails();
        }
        $meter_cube = 0;
        if (count($request->width)) {
            foreach ($request->width as $key => $val) {
                // calculate pricing
                $cm_cube = $request->width[$key] * $request->height[$key] * $request->length[$key];
                $meter_cube +=  $cm_cube / 1000000;
                $pricing = (($cm_cube / 10000) / 5) * 0.50;

                // store image
                if (isset($request->image[$key]) && $request->image[$key]) {
                    $time = time();
                    $imageName = 'booking_image_' . $key . '_' . $time . '.png';
                    $path = public_path('/storage/uploads/bookings/' . $booking->id . '/details') . '/' . $imageName;

                    if (!File::exists($path)) {
                        File::makeDirectory($path . 'original', 0775, true, true);
                    }
                    Image::make(file_get_contents($request->image[$key]))->save($path);
                }

                $data[$key]['image'] = isset($request->image[$key]) ? '/storage/uploads/bookings/' . $booking->id . '/details/' . $imageName : '';
                $data[$key]['description'] = ($request->description[$key]) ? $request->description[$key] : '';
                $data[$key]['width'] = $request->width[$key];
                $data[$key]['height'] = $request->height[$key];
                $data[$key]['length'] = $request->length[$key];
                $data[$key]['pricing'] = $pricing;
            }
        }
        $booking_details->parcel_details = json_encode($data);
        $booking_details->save();

        return $booking_details->id;
    }

    protected function pickupDate($request, $booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        if (!isset($booking_details->id)) {
            $booking_details = new BookingDetails();
        }

        $data['pickup_date'] = $request->pickup_date;
        $data['price'] = $request->price;

        $booking_details->pickup_date = json_encode($data);
        $booking_details->save();

        return $booking_details->id;
    }

    protected function pickupExtraHelp($request, $booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        if (!isset($booking_details->id)) {
            $booking_details = new BookingDetails();
        }

        if (!isset($request->type_id)) {
            $parcel_options = ParcelOption::whereJsonContains('step', 5)->where(['default' => 1])->first();
        } else {
            $parcel_options = ParcelOption::find($request->type_id);
        }

        $extra_help['id'] = $parcel_options->id;
        $extra_help['name'] = $parcel_options->name;
        $extra_help['description'] = $parcel_options->description;
        $extra_help['price'] = $parcel_options->price;

        $booking_details->booking_id = $booking->id;
        $booking_details->extra_help = json_encode($extra_help);
        $booking_details->save();

        return $booking_details->id;
    }

    protected function pickupFloor($request, $booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        if (!isset($booking_details->id)) {
            $booking_details = new BookingDetails();
        }

        if (!isset($request->type_id)) {
            $parcel_options = ParcelOption::whereJsonContains('step', 6)->where(['default' => 1])->first();
        } else {
            $parcel_options = ParcelOption::find($request->type_id);
        }

        $pickup_floor['id'] = $parcel_options->id;
        $pickup_floor['name'] = $parcel_options->name;
        $pickup_floor['description'] = $parcel_options->description;
        $pickup_floor['price'] = $parcel_options->price;

        $booking_details->booking_id = $booking->id;
        $booking_details->pickup_floor = json_encode($pickup_floor);
        $booking_details->save();
        return $booking_details->id;
    }

    protected function deliveryFloor($request, $booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        if (!isset($booking_details->id)) {
            $booking_details = new BookingDetails();
        }

        if (!isset($request->type_id) || $request->type_id == '') {
            $parcel_options = ParcelOption::whereJsonContains('step', 7)->where(['default' => 1])->first();
        } else {
            $parcel_options = ParcelOption::find($request->type_id);
        }

        $delivery_floor['id'] = $parcel_options->id;
        $delivery_floor['name'] = $parcel_options->name;
        $delivery_floor['description'] = $parcel_options->description;
        $delivery_floor['price'] = $parcel_options->price;

        $booking_details->booking_id = $booking->id;
        $booking_details->delivery_floor = json_encode($delivery_floor);
        $booking_details->save();
        return $booking_details->id;
    }

    protected function payment($request, $booking)
    {

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($booking->final_price, 2) // You must send the correct number of decimals, thus we enforce the use of strings
            ],
            "method" => strtolower($request->method),
            "description" => "Booking #$booking->id",
            "redirectUrl" => route('booking.success', ['locale' => App::getLocale()]),
            "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "booking_id" => $booking->id,
                "user_id" => $booking->user_id,
            ],
        ]);

        $booking->transaction_id = $payment->id;
        $booking->transaction_status = $payment->status;
        $this->save_payment($booking);
        // redirect customer to Mollie checkout page
        return $payment->getCheckoutUrl();
    }

    protected function save_payment($booking)
    {
        $booking_payment = BookingPayments::where('booking_id', $booking->id)->first();
        if (!isset($booking_payment->id)) {
            $booking_payment = new BookingPayments();
        }
        $booking_payment->booking_id = $booking->id;
        $booking_payment->amount = $booking->final_price;
        $booking_payment->transaction_id = $booking->transaction_id;
        $booking_payment->status = $booking->transaction_status;
        $booking_payment->save();

        unset($booking->transaction_id);
        unset($booking->transaction_status);
        $booking->payment_id = $booking_payment->id;
        $booking->save();
    }


    public function clear_booking(Request $request)
    {
        $booking = Booking::where('id', $request->id)->delete();
        BookingDetails::where('booking_id', $request->id)->delete();

        return response()->json(['status' => true, 'message' => 'Booking deleted successfully']);
    }


    public function last_location(Request $request)
    {
        return $this->last_location_info($request);
    }

    public function feedback(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required',
            'rating' => 'required',
            'review' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', [], 200);
        }

        // check if user is allowed for feedback
        $booking = Booking::when(Auth::user()->user_type == 'courier', function ($query) {
            $query->where("courier_user_id", Auth::id());
        }, function ($query) {
            $query->where("user_id", Auth::id());
        })->where('id', $request->booking_id)->first();

        if (!isset($booking->id)) {
            return $this->sendError('You are not associated with this booking', [], 200);
        }

        $feedback = BookingFeedback::updateorcreate(
            [
                'booking_id' => $request->booking_id,
                'user_id' => Auth::id()
            ],
            [
                'booking_id' => $request->booking_id,
                'user_id' => Auth::id(),
                'rating' => $request->rating,
                'review' => $request->review
            ]
        );

        return $this->sendResponse($feedback, 'Thank you!! For your feedback.');
    }

    public function invoice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', [], 200);
        }

        // check if user is allowed for feedback
        $booking = Booking::when(Auth::user()->user_type == 'courier', function ($query) {
            $query->where("courier_user_id", Auth::id());
        }, function ($query) {
            $query->where("user_id", Auth::id());
        })->where('id', $request->booking_id)->first();

        if (!isset($booking->id)) {
            return $this->sendError('You are not associated with this booking', [], 200);
        }

        $data['boooking_details'] = $booking;
        $data['invoice_url'] = url('booking-invoice/' . $booking->id);
        $data['payment_status'] = 'Pending';

        return $this->sendResponse($data, 'Please download the invoice from the above url.');
    }
}
