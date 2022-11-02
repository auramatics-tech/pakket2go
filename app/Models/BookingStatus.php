<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App;

class BookingStatus extends Model
{
    use HasFactory;

    protected $table = 'booking_status';
}
