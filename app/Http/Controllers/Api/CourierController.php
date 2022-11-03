<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;

use App\Http\Traits\BookingTrait;

use App\Models\Booking;
use App\Models\BookingTracking;
use App\Models\CourierCanceledBookings;
use App\Models\UserLocation;

use Auth;
use Image;
use File;


class CourierController extends BaseController
{
    use BookingTrait;

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
        $bookings = Booking::select('bookings.*')->when($status, function ($query) use ($status) {
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
        $booking = Booking::select('bookings.*')->when($status, function ($query) use ($status) {
            $query->join('booking_status', 'booking_status.id', '=', 'bookings.status')
                ->where(function ($q)  use ($status) {
                    if ($status == 'accepted')
                        $q->where('booking_status.status_type', 'ready-to-pickup')->orwhere("booking_status.status", 'ready-to-pickup');
                    elseif ($status == 'pickedup')
                        $q->where("booking_status.status", 'Pickedup');
                    elseif ($status == 'delivered')
                        $q->where("booking_status.status", 'Delivered');
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
            ->where('bookings.booking_code', $request->parcel_code)
            ->first();
        if (isset($booking->id)) {
            if ($status == 'accepted' || $status == 'pickedup' || $status == 'delivered') {
                $signature = '';
                $booking->courier_user_id = Auth::id();
                if ($status == 'pickedup') {
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
            } elseif ($status == 'rejected') {
                $canceled_bookings = CourierCanceledBookings::where(['user_id' => Auth::id(), 'booking_id' => $request->booking_id])->first();
                if (!isset($canceled_bookings->id)) {
                    $canceled_bookings = new CourierCanceledBookings();
                }
                $canceled_bookings->user_id = Auth::id();
                $canceled_bookings->booking_id = $request->booking_id;
                $canceled_bookings->save();
            }

            return $this->sendResponse([$booking], 'Booked ' . $status . ' successfully');
        }

        return $this->sendResponse([], 'Booking doesn\'t exists or ' . $status . ' already, Please try with another booking');
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
            'long' => 'required',
            'accuracy' => 'required',
            'rotation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['result' => "", 'status' => false, 'message' => "Validation Error"], 200);
        }

        $location = new UserLocation();
        $location->user_id = Auth::id();
        $location->latitude = $request->lat;
        $location->longitude = $request->lat;
        $location->accuracy = $request->accuracy;
        $location->rotation = $request->rotation;

        if (isset($request->parcel_code) && $request->parcel_code) {
            $booking = Booking::where('booking_code', $request->parcel_code)->where("courier_user_id", Auth::id())->first();
            if (!isset($booking->id)) {
                return $this->sendResponse([], 'Invalid booking');
            }
            $location->booking_id = $request->parcel_code;
        }

        $location->save();
        return $this->sendResponse([], 'Location updated successfully.');
    }

    public function earnings()
    {
        $bookings = Booking::where('courier_user_id', Auth::id())
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
}