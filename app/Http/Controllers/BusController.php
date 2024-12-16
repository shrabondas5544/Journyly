<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function search(Request $request)
    {
        $query = Bus::query();
    
        // Add debugging
        \Log::info('Search Request:', $request->all());
    
        // Apply filters
        if ($request->from) {
            $query->where('from_location', 'like', '%' . $request->from . '%');
        }
        if ($request->to) {
            $query->where('to_location', 'like', '%' . $request->to . '%');
        }
        if ($request->departure_date) {
            $query->whereDate('journey_date', $request->departure_date);
        }

        // Fix array handling
        if ($request->has('bus_type') && is_array($request->bus_type)) {
            $query->whereIn('bus_type', $request->bus_type);
        }

        if ($request->has('operators') && is_array($request->operators)) {
            $query->whereIn('operator_name', $request->operators);
        }

        if ($request->has('boarding_points') && is_array($request->boarding_points)) {
            $query->whereIn('boarding_point', $request->boarding_points);
        }
    
        // Add sorting - move this before get()
        if ($request->sort === 'low_to_high') {
            $query->orderBy('discounted_price', 'asc');
        } elseif ($request->sort === 'high_to_low') {
            $query->orderBy('discounted_price', 'desc');
        }

        // Get results only once
        $buses = $query->get();
    
        // Add debugging
        \Log::info('Query Results:', ['count' => $buses->count()]);

        if ($request->ajax()) {
            return response()->json($buses);
        }

        return view('bus', compact('buses'));
    }
}
