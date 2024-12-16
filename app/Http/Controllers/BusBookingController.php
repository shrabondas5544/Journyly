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
        
        // Pass both bus and user data to the view
        return view('busbooking', [
            'bus' => $bus,
            'user' => $user
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

        try {
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

            return redirect()->route('account.dashboard')->with('success', 'Hey '. Auth::user()->name .' your bus booked successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating booking: ' . $e->getMessage());
        }
    }
}