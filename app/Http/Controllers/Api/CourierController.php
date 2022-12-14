<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

use App\Http\Traits\BookingTrait;
use App\Http\Traits\NotificationTrait;

use App\Models\Booking;
use App\Models\BookingTracking;
use App\Models\CourierCanceledBookings;
use App\Models\UserLocation;
use App\Models\User;

use Auth;
use Image;
use File;
use DB;


class CourierController extends BaseController
{
    use BookingTrait, NotificationTrait;

    function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->user_type != 'courier')
                return $this->sendError('Action not allowed for this user.', []);

            return $next($request);
        });
    }

    public function bookings(Request $request)
    {
        $status = $request->status;
        $bookings = Booking::when(isset($request->latlong) && $request->latlong, function ($query) use ($request) {
            $latlng = explode(',', $request->latlong);

            $query->select(
                'bookings.*',
                DB::raw('SQRT( POW(69.1 * (`pickup_lat` - ' . $latlng[0] . '), 2) + POW(69.1 * (' . $latlng[1] . ' - `pickup_lng`) * COS(`pickup_lat` / 57.3), 2)) AS distance')
            )
                ->join('booking_address', 'booking_address.booking_id', '=', 'bookings.id');
        }, function ($query) {
            $query->select('bookings.*');
        })
            ->when($status, function ($query) use ($status) {
                $query->join('booking_status', 'booking_status.id', '=', 'bookings.status')
                    ->where(function ($q)  use ($status) {
                        $q->where('booking_status.status_type', $status)->orwhere("booking_status.status", $status);
                    });
            })
            ->whereNotIn('bookings.id', function ($query) {
                $query->select('booking_id')
                    ->from("courier_canceled_bookings")
                    ->where('user_id', Auth::id());
            })
            ->when(isset($request->latlong) && $request->latlong, function ($query) {
                $query->having("distance", "<=", 45);
            })
            ->whereNull("courier_user_id")
            ->get();

        if (count($bookings)) {
            foreach ($bookings as $booking) {
                $this->booking_data($booking);
            }
        }
        return $this->sendResponse($bookings, 'Bookings fetched successfully');
    }

    public function update_booking(Request $request)
    {
        $status = $request->status;

        if ($status == 'accepted') {
            // check if any other booking is pending for delivery
            $bookings = Booking::where('courier_user_id', Auth::id())->where('status', '<', 5)->count();
            if ($bookings) {
                return $this->sendError('Please deliver current order first', [],  200);
            }
        }

        $booking = Booking::select('bookings.*', 'users.device_token')->when($status, function ($query) use ($status) {
            $query->join('booking_status', 'booking_status.id', '=', 'bookings.status')
                ->where(function ($q)  use ($status) {
                    if ($status == 'accepted')
                        $q->where('booking_status.status_type', 'ready-to-pickup');
                    elseif ($status == 'pickedup')
                        $q->where("booking_status.status_type", 'accepted');
                    elseif ($status == 'delivered')
                        $q->where("booking_status.status_type", 'pickedup');
                });
        })
            ->whereNotIn('bookings.id', function ($query) {
                $query->select('booking_id')
                    ->from("courier_canceled_bookings")
                    ->where('user_id', Auth::id());
            })
            ->where(function ($query) {
                $query->whereNull("courier_user_id")->orwhere('courier_user_id', Auth::id());
            })
            ->join("users", "users.id", "=", "bookings.user_id")
            ->where('bookings.id', $request->booking_id)
            ->first();

        if (isset($booking->id)) {
            if ($status == 'accepted' || $status == 'pickedup' || $status == 'delivered') {
                $signature = '';
                $booking->courier_user_id = Auth::id();
                if ($status == 'accepted') {
                    $booking->status = 3;
                } elseif ($status == 'pickedup') {
                    $booking->status = 4;
                } elseif ($status == 'delivered') {
                    $booking->status = 5;
                    if ($request->signature) {
                        $signature = "sign_" . time() . ".png";
                        $storage_path = '/storage/uploads/bookings/' . $booking->id . '/signature';
                        $path = public_path($storage_path) . '/' . $signature;
                        if (!File::exists($path)) {
                            File::makeDirectory($path . 'original', 0775, true, true);
                        }
                        Image::make(file_get_contents($request->signature))->save($path);
                        $signature = $storage_path . '/' . $signature;
                    }
                }
                $booking->save();
                $this->save_tracking($booking, $status, $signature);
                if ($booking->device_token)
                    $this->sendPushNotification($booking->device_token, 'Booking status changed to ' . ucfirst($status), 'booking', $booking->id);
            } elseif ($status == 'rejected') {
                $canceled_bookings = CourierCanceledBookings::where(['user_id' => Auth::id(), 'booking_id' => $request->booking_id])->first();
                if (!isset($canceled_bookings->id)) {
                    $canceled_bookings = new CourierCanceledBookings();
                }
                $canceled_bookings->user_id = Auth::id();
                $canceled_bookings->booking_id = $request->booking_id;
                $canceled_bookings->save();
            }
            $this->booking_data($booking);
            return $this->sendResponse($booking, 'Booked ' . $status . ' successfully');
        }

        return $this->sendError('Booking doesn\'t exists or ' . $status . ' already, Please try with another booking',[],403);
    }

    protected function save_tracking($booking, $status, $signature)
    {
        $tracking = BookingTracking::where('booking_id', $booking->id)->first();
        if (!isset($tracking->id)) {
            $tracking = new BookingTracking();
        }

        $status = $status . '_time';
        $tracking->booking_id = $booking->id;
        $tracking->{$status} = date("Y-m-d H:i:s");
        $tracking->signature = $signature;
        $tracking->save();
    }

    public function last_location(Request $request)
    {
        return $this->last_location_info($request);
    }

    public function update_location(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'lat' => 'required',
            'long' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => "", 'status' => false, 'message' => "Validation Error"], 200);
        }

        $last_location = UserLocation::where('user_id', Auth::id())->latest()->first();
        if (isset($last_location->latitude) && $last_location->latitude == $request->lat && isset($last_location->longitude) && $last_location->longitude == $request->long) {
            $location = $last_location;
        } else {
            $location = new UserLocation();
        }
        $location->user_id = Auth::id();
        $location->latitude = $request->lat;
        $location->longitude = $request->long;
        $location->accuracy = $request->accuracy;
        $location->rotation = $request->rotation;


        // check if user is with any booking
        $booking = Booking::where(function ($query) {
            $query->where('status', 3)->orwhere('status', 4);
        })->where("courier_user_id", Auth::id())->first();
        if (isset($booking->id) && $booking->id) {
            $location->booking_id = $booking->id;
        }

        $location->save();
        return $this->sendResponse([$location], 'Location updated successfully.');
    }

    public function earnings()
    {
        $bookings = Booking::select('bookings.*')->where('courier_user_id', Auth::id())
            ->join('booking_tracking', 'booking_tracking.booking_id', '=', 'bookings.id')
            ->whereNotNull("delivered_time")
            ->get();

        $total_earnings = 0;

        if (count($bookings)) {
            foreach ($bookings as $booking) {
                $total_earnings += $booking->courier_price;
                $this->booking_data($booking);
            }
        }

        $data['parcel_list'] = $bookings;
        $data['totalparcel'] = count($bookings);
        $data['totalearn'] = number_format($total_earnings);

        return $this->sendResponse($data, 'Earnings fetched successfully.');
    }

    public function update_documents(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'iban' => 'required',
            'holder_name' => 'required',
            'front_driving_license' => 'required',
            'back_driving_license' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => "", 'status' => false, 'message' => "Validation Error"], 200);
        }

        $user = User::find(Auth::id());

        if ($request->front_driving_license) {
            $front_driving_license = "document_" . time() . ".png";
            $storage_path = '/storage/uploads/user/' . Auth::id() . '/documents';
            $path = public_path($storage_path) . '/' . $front_driving_license;
            if (!File::exists($path)) {
                File::makeDirectory($path . 'original', 0775, true, true);
            }
            Image::make(file_get_contents($request->front_driving_license))->save($path);
            $user->front_driving_license = $storage_path . '/' . $front_driving_license;
        }

        if ($request->back_driving_license) {
            $back_driving_license = "document_" . time() . ".png";
            $storage_path = '/storage/uploads/user/' . Auth::id() . '/documents';
            $path = public_path($storage_path) . '/' . $back_driving_license;
            if (!File::exists($path)) {
                File::makeDirectory($path . 'original', 0775, true, true);
            }
            Image::make(file_get_contents($request->back_driving_license))->save($path);
            $user->back_driving_license = $storage_path . '/' . $back_driving_license;
        }

        if ($request->chamber_of_commerce) {
            $chamber_of_commerce = "document_" . time() . ".png";
            $storage_path = '/storage/uploads/user/' . Auth::id() . '/documents';
            $path = public_path($storage_path) . '/' . $chamber_of_commerce;
            if (!File::exists($path)) {
                File::makeDirectory($path . 'original', 0775, true, true);
            }
            Image::make(file_get_contents($request->chamber_of_commerce))->save($path);
            $user->chamber_of_commerce = $storage_path . '/' . $chamber_of_commerce;
        }

        $user->documents_verified = 0;
        $user->iban = $request->iban;
        $user->holder_name = $request->holder_name;
        $user->save();

        $user->documentsUploaded  = 1;
        $user->front_driving_license = asset($user->front_driving_license);
        $user->back_driving_license = asset($user->back_driving_license);
        $user->chamber_of_commerce = asset($user->chamber_of_commerce);

        return $this->sendResponse($user, 'Documents uploaded successfully. We will review and get back');
    }
}
