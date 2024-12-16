<?php
namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\FlightBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class FlightBookingController extends Controller
{
    public function show($id)
    {
        $flight = Flight::findOrFail($id);
        return view('flightbooking', compact('flight'));
    }

    public function store(Request $request, $id)
    {
        Log::info('Flight booking request:', $request->all());

        // Validate the request
        $validated = $request->validate([
            'booking_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:booking_date',
            'return_date' => 'nullable|date|after_or_equal:departure_date',
            'passengers' => 'required|integer|min:1|max:10',
            'card_number' => 'required|numeric|digits:16',
            'cvv' => 'required|numeric|digits:3',
            'expiration_date' => 'required|date|after:today',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'savings' => 'required|numeric',
            'total' => 'required|numeric'
        ]);

        // Find the flight
        $flight = Flight::findOrFail($id);

        // Check seat availability
        if ($flight->available_seats < $request->passengers) {
            return back()->withErrors(['message' => 'Not enough seats available']);
        }

        try {
            // Create booking
            $booking = FlightBooking::create([
                'user_id' => Auth::id(),
                'flight_id' => $flight->id,
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'user_phone' => Auth::user()->phone ?? '',
                'airline_name' => $flight->airline_name,
                'from_location' => $flight->from_location,
                'to_location' => $flight->to_location,
                'flight_class' => $flight->flight_class,
                'flight_number' => $flight->flight_number,
                'departure_time_slot' => $flight->departure_time_slot,
                'arrival_time_slot' => $flight->arrival_time_slot,
                'booking_date' => $request->booking_date,
                'departure_date' => $request->departure_date,
                'return_date' => $request->return_date,
                'number_of_passengers' => $request->passengers,
                'baggage_allowance' => $flight->baggage_allowance,
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'savings' => $request->savings,
                'total' => $request->total,
                'payment_status' => 'pending'
            ]);

            // Update available seats
            $flight->decrement('available_seats', $request->passengers);

            Log::info('Flight booking successful:', [
                'booking_id' => $booking->id,
                'user_id' => Auth::id(),
                'flight_id' => $flight->id,
                'booking_date' => $request->booking_date,
                'passengers' => $request->passengers
            ]);

            return redirect()
                ->route('account.dashboard')
                ->with('success', 'Hey '. Auth::user()->name .' your flight booked successfully!');

        } catch (\Exception $e) {
            Log::error('Flight booking failed:', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'flight_id' => $flight->id
            ]);

            return back()->withErrors(['message' => 'Booking failed. Please try again.']);
        }
    }
}