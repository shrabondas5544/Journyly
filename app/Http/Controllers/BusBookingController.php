<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusBookingController extends Controller
{
    public function show($id)
    {
        // Get authenticated user
        $user = Auth::user();
        
        
        // Fetch bus details based on ID
        $bus = Bus::findOrFail($id);

        // Add validation for no available seats
        if ($bus->available_seats <= 0) {
            return back()->with('error', 'Sorry, this bus is fully booked.');
        }
        
        // Pass both bus and user data to the view
        return view('busbooking', [
            'bus' => $bus,
            'user' => $user,
            'available_seats' => $bus->available_seats
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'passengers' => 'required|integer|min:1|max:10',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'savings' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $bus = Bus::findOrFail($id);

        // Check if enough seats are available
        if ($bus->available_seats < $request->passengers) {
            return back()->with('error', 'Sorry, only ' . $bus->available_seats . ' seats available. Please reduce the number of passengers.');
        }


        try {

            \DB::beginTransaction();

            $booking = BusBooking::create([
                'user_id' => Auth::id(),
                'bus_id' => $id,
                'user_name' => Auth::user()->name,
                'operator_name' => $bus->operator_name,
                'from_location' => $bus->from_location,
                'to_location' => $bus->to_location,
                'bus_type' => $bus->bus_type,
                'boarding_point' => $bus->boarding_point,
                'departure_date' => $bus->journey_date,
                'booking_date' => $request->date,
                'number_of_passengers' => $request->passengers,
                'subtotal' => floatval($request->subtotal),
                'tax' => floatval($request->tax),
                'savings' => floatval($request->savings),
                'total' => floatval($request->total),
                'payment_status' => 'pending'
            ]);

            // Update available seats
            $bus->decrement('available_seats', $request->passengers);

            // Commit the transaction
            \DB::commit();

            return redirect()->route('account.dashboard')->with('success', 'Hey '. Auth::user()->name .' your bus booked successfully!');
        } catch (\Exception $e) {

            \DB::rollback();
            return back()->with('error', 'Error creating booking: ' . $e->getMessage());
        }
    }
}