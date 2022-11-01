<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App;

class BookingTracking extends Model
{
    use HasFactory;

    protected $table = 'booking_tracking';

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            $model->tracking_number = 'TRAC-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
            $model->save();
        });
    }
}
