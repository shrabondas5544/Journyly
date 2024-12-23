<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Bus;
use App\Models\BusBooking;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminBusController extends Controller
{
    public function index()
    {
        // Get bookings with user relationship
        $bookings = BusBooking::with('user')->latest()->get();
       
        // Get all buses
        $buses = Bus::latest()->get();
       
        // Calculate Statistics
        $stats = [
            'total_buses' => Bus::count(),
            'total_bookings' => BusBooking::count(),
            'total_revenue' => BusBooking::where('payment_status', 'paid')->sum('total'),
            'paid' => BusBooking::where('payment_status', 'paid')->count(),
            'pending' => BusBooking::where('payment_status', 'pending')->count()
        ];

        // Operator stats
        $operatorStats = Bus::select('operator_name')
            ->selectRaw('count(*) as count')
            ->groupBy('operator_name')
            ->get()
            ->pluck('count', 'operator_name')
            ->toArray();

        // Bus type stats
        $busTypeStats = Bus::select('bus_type')
            ->selectRaw('count(*) as count')
            ->groupBy('bus_type')
            ->get()
            ->pluck('count', 'bus_type')
            ->toArray();
   
        return view('admin.buspanel', compact('bookings', 'buses', 'stats', 'operatorStats', 'busTypeStats'));
    }

    public function create()
    {
        return view('admin.add-bus');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'operator_name' => 'required|string',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'journey_date' => 'required|date',
            'original_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'available_seats' => 'required|integer',
            'bus_type' => 'required|in:AC,Non AC',
            'boarding_point' => 'required|string',
            'operator_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('operator_logo')) {
            $file = $request->file('operator_logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/operator_logos', $filename);
            $validated['operator_logo'] = 'operator_logos/' . $filename;
        }

        Bus::create($validated);
        return redirect()->route('admin.buspanel')
            ->with('success', 'Bus added successfully!');
    }

    public function updateStatus(BusBooking $booking)
    {
        $booking->update(['payment_status' => 'paid']);
        return redirect()->back()->with('success', 'Booking status updated successfully');
    }

    // Ajax endpoints for dynamic content loading
    public function getBusList()
    {
        $buses = Bus::latest()->get();
        return response()->json($buses);
    }

    public function getStats()
    {
        $stats = [
            'total_buses' => Bus::count(),
            'total_bookings' => BusBooking::count(),
            'total_revenue' => BusBooking::where('payment_status', 'paid')->sum('total'),
            'paid' => BusBooking::where('payment_status', 'paid')->count(),
            'pending' => BusBooking::where('payment_status', 'pending')->count()
        ];
        return response()->json($stats);
    }

    public function destroy(Bus $bus)
    {
        try {
            $bus->delete();
            return redirect()->route('admin.buspanel')
                ->with('success', 'Bus deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.buspanel')
                ->with('error', 'Error deleting bus: ' . $e->getMessage());
        }
    }

    public function sendNotification(Request $request, $bookingId)
    {
        try {
            $booking = BusBooking::findOrFail($bookingId);
        
            $validated = $request->validate([
                'message' => 'required|string|max:500'
            ]);

            $notification = Notification::create([
                'user_id' => $booking->user_id,
                'message' => $validated['message']
            ]);

            \Log::info('Notification created:', ['notification_id' => $notification->id, 'user_id' => $booking->user_id]);

            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error sending notification:', [
                'error' => $e->getMessage(),
                'booking_id' => $bookingId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send notification: ' . $e->getMessage()
            ], 500);
        }
    }
}