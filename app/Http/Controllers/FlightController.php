<?php

// app/Http/Controllers/FlightController.php
namespace App\Http\Controllers;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlightController extends Controller
{
    public function index()
    {
        return view('flight');
    }

    public function search(Request $request)
    {
        Log::info('Flight search request:', $request->all());
        
        $query = Flight::query();
   
        // Basic filters
        if ($request->filled('from')) {
            $query->where('from_location', 'like', '%' . $request->from . '%');
        }
        if ($request->filled('to')) {
            $query->where('to_location', 'like', '%' . $request->to . '%');
        }
        if ($request->filled('departure_date')) {
            $query->whereDate('departure_date', $request->departure_date);
        }
        if ($request->filled('return_date')) {
            $query->whereDate('return_date', $request->return_date);
        }
       
        // Time slot filters
        if ($request->has('departure_time_slots')) {
            $slots = is_array($request->departure_time_slots) ? $request->departure_time_slots : [$request->departure_time_slots];
            $query->whereIn('departure_time_slot', $slots);
        }
       
        if ($request->has('arrival_time_slots')) {
            $slots = is_array($request->arrival_time_slots) ? $request->arrival_time_slots : [$request->arrival_time_slots];
            $query->whereIn('arrival_time_slot', $slots);
        }

        // Other filters
        if ($request->has('flight_class')) {
            $classes = is_array($request->flight_class) ? $request->flight_class : [$request->flight_class];
            $query->whereIn('flight_class', $classes);
        }
        if ($request->has('airlines')) {
            $airlines = is_array($request->airlines) ? $request->airlines : [$request->airlines];
            $query->whereIn('airline_name', $airlines);
        }
        if ($request->has('baggage_allowance')) {
            $allowances = is_array($request->baggage_allowance) ? $request->baggage_allowance : [$request->baggage_allowance];
            $query->whereIn('baggage_allowance', $allowances);
        }

        // Price range
        if ($request->filled('max_price')) {
            $query->where('discounted_price', '<=', $request->max_price);
        }
   
        // Sorting
        if ($request->sort === 'low_to_high') {
            $query->orderBy('discounted_price', 'asc');
        } elseif ($request->sort === 'high_to_low') {
            $query->orderBy('discounted_price', 'desc');
        }

        $flights = $query->get();
        Log::info('Flight search results:', ['count' => $flights->count()]);
   
        if ($request->ajax()) {
            return response()->json($flights);
        }
        return view('flight', compact('flights'));
    }
}
