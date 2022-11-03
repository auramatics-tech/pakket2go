<?php

namespace App\Http\Traits;

use App\Models\BookingDetails;
use App\Models\BookingStep;
use App\Models\UserLocation;
use App\Models\SiteSetting;
use Auth;

trait BookingTrait
{

    protected function calcualte_distance_price($request, $booking)
    {
        $totaldistance =  $request->get('distance');
        $parcelrate = SiteSetting::select('startprice', 'level1', 'level2', 'level3')->find(1);
        if ($totaldistance <= 20) {
            //startprice
            $pricekm = $parcelrate->startprice;
            $price = round($pricekm, 2);
        } else if ($totaldistance > 20 && $totaldistance <= 100) {
            //level1
            $pricekm = $parcelrate->level1;
            $price = round($totaldistance * $pricekm, 2);
        } else if ($totaldistance > 100 && $totaldistance <= 200) {
            //level2
            $pricekm = $parcelrate->level2;
            $price = round($totaldistance * $pricekm, 2);
        } else if ($totaldistance > 200) {
            //level3
            $pricekm = $parcelrate->level3;
            $price = round($totaldistance * $pricekm, 2);
        }
        $booking->distance_price = $price;
        $booking->save();
    }

    protected function calculate_final_price($booking)
    {
        $booking_details = BookingDetails::where('booking_id', $booking->id)->first();
        $parcelcharge = SiteSetting::pluck('parcelcharge')->first();

        $price = 0;

        // echo $booking->booking_data($booking_details, 'parcel_details', 'price');die;

        $price += $booking->booking_data($booking_details, 'parcel_type', 'price');
        $price += $booking->booking_data($booking_details, 'parcel_details', 'price');
        $price += $booking->booking_data($booking_details, 'pickup_extra_help', 'price');
        $price += $booking->booking_data($booking_details, 'pickup_floor', 'price');
        $price += $booking->booking_data($booking_details, 'delivery_floor', 'price');

        $commission = $price * $parcelcharge / 100;
        $courier_price = $price - $commission;

        $booking->courier_price = $courier_price;
        $booking->final_price = $price + $booking->distance_price;
        $booking->save();
        $final_price = array();

        $steps = BookingStep::where('status', 1)->orderby('order', 'asc')->get();
        if (count($steps)) {
            $key = 0;
            foreach ($steps as $step_key => $step) {
                if ($step->id == '1') {
                    $final_price[$key]['name'] = "Distance " . $booking->address->distance . " Km";
                    $final_price[$key]['price'] = number_format($booking->distance_price, 2);
                    $final_price[$key]['step'] = $step->id;
                    $key++;
                } else if ($step->id == '3') {
                    $data = $booking->booking_data($booking_details, 'parcel_details', 'all');
                    foreach ($data as $parcel_details) {
                        $final_price[$key]['name'] = $parcel_details['name'];
                        $final_price[$key]['price'] = number_format($parcel_details['price'], 2);
                        $final_price[$key]['step'] = $step->id;
                        $key++;
                    }
                } else {
                    $type = implode('_', explode('-', $step->url_code));
                    if ($booking->booking_data($booking_details, $type, 'name')) {
                        $final_price[$key]['name'] = $booking->booking_data($booking_details, $type, 'name');
                        $final_price[$key]['price'] = $booking->booking_data($booking_details, $type, 'price');
                        $final_price[$key]['step'] = $step->id;
                        $key++;
                    }
                }
            }
        }

        return $final_price;
    }

    protected function booking_data($booking)
    {
        $booking_details = isset($booking->details) ? $booking->details : '';
        $booking->booking_status = $booking->booking_status();
        $booking->address = $booking->address;
        $booking->parcel_type = ($booking_details) ? $this->decode_detail(json_decode($booking_details->parcel_type)) : [];
        $booking->parcel_details =  ($booking_details) ? json_decode($booking_details->parcel_details) : [];
        $booking->pickup_date =  ($booking_details) ? json_decode($booking_details->pickup_date) : [];
        $booking->extra_help =  ($booking_details) ? json_decode($booking_details->extra_help) : [];
        $booking->pickup_floor =  ($booking_details) ? $this->decode_detail(json_decode($booking_details->pickup_floor)) : [];
        $booking->delivery_floor =  ($booking_details) ? $this->decode_detail(json_decode($booking_details->delivery_floor)) : [];
        unset($booking->details);

        return $booking;
    }

    protected function decode_detail($details)
    {
        foreach ($details as $key => $detail) {
            $details->{$key} = json_decode($detail);
        }

        return  $details;
    }

    protected function last_location_info($request)
    {
        $last_location = UserLocation::when($request->booking_id, function ($query) use ($request) {
            $query->where("booking_id", $request->booking_id);
        })
            ->where("user_id", Auth::id())
            ->latest()
            ->first();

        if (isset($last_location->id)) {
            return $this->sendResponse([$last_location], 'Last location fetched successfully');
        } else {
            return $this->sendResponse([], 'Location not found');
        }
    }
}
