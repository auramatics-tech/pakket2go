<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App;

class BookingPayments extends Model
{
    use HasFactory;

    protected $table = 'booking_payments';
}
