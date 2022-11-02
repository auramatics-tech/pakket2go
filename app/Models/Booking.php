<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App;

class Booking extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->booking_code = 'BOOKING-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
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

    public function booking_data($details, $type, $return)
    {
        $parcel_type =  isset($details->{$type}) ? json_decode($details->{$type}) : '';

        $data['id'] = isset($parcel_type->id) ? $parcel_type->id : '';
        $data['date'] = isset($parcel_type->pickup_date) ? $parcel_type->pickup_date : '';
        $data['name'] = isset($parcel_type->name) ? json_decode($parcel_type->name)->{App::getLocale()} : '';
        $data['description'] = isset($parcel_type->description) ? json_decode($parcel_type->description)->{App::getLocale()} : '';
        $data['price'] = isset($parcel_type->price) ? number_format($parcel_type->price, 2) : 0;

        return isset($data[$return]) ? $data[$return] : 0;
    }
}
