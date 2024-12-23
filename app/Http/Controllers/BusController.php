<?php
namespace App\Http\Controllers;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BusController extends Controller
{
    public function search(Request $request)
    {
        $query = Bus::query();
   
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
        if ($request->has('bus_type') && is_array($request->bus_type)) {
            $query->whereIn('bus_type', $request->bus_type);
        }
        if ($request->has('operators') && is_array($request->operators)) {
            $query->whereIn('operator_name', $request->operators);
        }
        if ($request->has('boarding_points') && is_array($request->boarding_points)) {
            $query->whereIn('boarding_point', $request->boarding_points);
        }
   
        // Add sorting
        if ($request->sort === 'low_to_high') {
            $query->orderBy('discounted_price', 'asc');
        } elseif ($request->sort === 'high_to_low') {
            $query->orderBy('discounted_price', 'desc');
        }

        // Get results and process BLOB data
        $buses = $query->get()->map(function ($bus) {
            $data = $bus->toArray();
            
            // Process the logo
            if (!empty($data['operator_logo'])) {
                try {
                    // Convert binary data to base64
                    $base64 = base64_encode($data['operator_logo']);
                    // Add data URI scheme
                    $data['operator_logo'] = "data:image/jpeg;base64,{$base64}";
                    
                    Log::info("Processed logo for {$data['operator_name']}", [
                        'logo_length' => strlen($base64)
                    ]);
                } catch (\Exception $e) {
                    Log::error("Error processing logo for {$data['operator_name']}: " . $e->getMessage());
                    $data['operator_logo'] = null;
                }
            } else {
                $data['operator_logo'] = null;
            }
            
            return $data;
        });

        if ($request->ajax()) {
            return response()->json($buses);
        }
        
        return view('bus', compact('buses'));
    }
}