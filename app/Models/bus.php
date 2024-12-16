<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bus extends Model
{
    protected $fillable = [
        'operator_name',
        'from_location',
        'to_location',
        'departure_time',
        'arrival_time',
        'journey_date',
        'original_price',
        'discounted_price',
        'available_seats',
        'operator_logo',
        'bus_type',
        'boarding_point'
    ];
}
