<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightBooking extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'user_name',
        'user_email',
        'user_phone',
        'airline_name',
        'from_location',
        'to_location',
        'flight_class',
        'flight_number',
        'departure_time_slot',
        'arrival_time_slot',
        'booking_date',
        'departure_date',
        'return_date',
        'number_of_passengers',
        'baggage_allowance',
        'subtotal',
        'tax',
        'savings',
        'total',
        'payment_status',
        'card_number',
        'cvv',
        'expiration_date'
    ];

    protected $dates = [
        'booking_date',
        'departure_date',
        'return_date',
        'expiration_date',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    // Hide sensitive information when converting to array/json
    //protected $hidden = [
    //    'card_number',
    //    'cvv',
    //    'expiration_date'
    //];

    public function show($id)
    {
        $flight = Flight::findOrFail($id);
        // Get the price from the request or use the flight's price
        $flight->discounted_price = floatval(request('flight_price', $flight->discounted_price));
        return view('flightbooking', compact('flight'));
    }
}