<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusBooking extends Model
{
    protected $fillable = [
        'user_id',
        'bus_id',
        'user_name',
        'operator_name',
        'from_location',
        'to_location',
        'bus_type',
        'boarding_point',
        'departure_date',
        'booking_date',
        'number_of_passengers',
        'subtotal',
        'tax',
        'savings',
        'total',
        'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}