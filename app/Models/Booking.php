<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App;
use DB;

use function PHPUnit\Framework\returnSelf;

class Booking extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->booking_code = 'P2G-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }

    public function booking_status()
    {
        return ucfirst(implode(' ', explode('-', BookingStatus::where('id', $this->status)->pluck('status_type')->first())));
    }

    public function payment_status()
    {
        return $this->hasOne(BookingPayments::class);
    }

    public function address()
    {
        return $this->hasOne(BookingAddress::class);
    }

    public function details()
    {
        return $this->hasOne(BookingDetails::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking_data($details, $type, $return)
    {
        $parcel_type =  isset($details->{$type}) ? json_decode($details->{$type}) : '';
        if ($type == 'parcel_details') {
            $price = 0;
            if (count($parcel_type)) {
                foreach ($parcel_type as $key => $p_type) {
                    $data[$key]['image'] = isset($p_type->image) ? $p_type->image : '';
                    $data[$key]['name'] = isset($p_type->width) ? ($p_type->width . 'x' . $p_type->height . 'x' . $p_type->length) . ' cm' : '';
                    $data[$key]['description'] = isset($p_type->description) ? $p_type->description : '';
                    $data[$key]['price'] = isset($p_type->pricing) ? number_format($p_type->pricing, 2) : 0;
                    $price += $data[$key]['price'];
                }
            }
            if ($return == 'price')
                return $price;
            else
                return isset($data) ? $data : [];
        } else {
            $data['id'] = isset($parcel_type->id) ? $parcel_type->id : '';
            $data['date'] = isset($parcel_type->pickup_date) ? $parcel_type->pickup_date : '';
            $data['name'] = isset($parcel_type->name) ? json_decode($parcel_type->name)->{App::getLocale()} : '';
            $data['description'] = isset($parcel_type->description) ? json_decode($parcel_type->description)->{App::getLocale()} : '';
            $data['price'] = isset($parcel_type->price) ? number_format($parcel_type->price, 2) : 0;
            return isset($data[$return]) ? $data[$return] : 0;
        }
    }


    public function courier_details()
    {
        $url = url('/');
        return $this->belongsTo(User::class, 'courier_user_id')->select(
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
            'device_token'
        );
    }
}
