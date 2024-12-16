<?php

// app/Models/Flight.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'airline_name',
        'from_location',
        'to_location',
        'departure_time_slot',
        'arrival_time_slot',
        'departure_date',
        'return_date',
        'original_price',
        'discounted_price',
        'available_seats',
        'airline_logo',
        'flight_class',
        'baggage_allowance',
        'flight_number'
    ];

    public function getReadableDepartureTime()
    {
        return $this->getReadableTimeSlot($this->departure_time_slot);
    }

    public function getReadableArrivalTime()
    {
        return $this->getReadableTimeSlot($this->arrival_time_slot);
    }

    private function getReadableTimeSlot($slot)
    {
        $slots = [
            '12am_6am' => '12am - 6am',
            '6am_12pm' => '6am - 12pm',
            '12pm_6pm' => '12pm - 6pm',
            '6pm_12am' => '6pm - 12am'
        ];
        return $slots[$slot] ?? $slot;
    }
}