<?php

namespace App\Http\Controllers\admin;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Models\FlightBooking;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FlightBookingsExport;

class AdminFlightController extends Controller
{
    public function index()
    {
        $flights = Flight::all();
        $bookings = FlightBooking::with('user')->get();

        // Calculate statistics
        $stats = [
            'total_flights' => Flight::count(),
            'total_bookings' => FlightBooking::count(),
            'total_revenue' => FlightBooking::where('payment_status', 'paid')->sum('total'),
            'paid_bookings' => FlightBooking::where('payment_status', 'paid')->count(),
            'pending_bookings' => FlightBooking::where('payment_status', 'pending')->count(),
        ];

        // Flight class distribution
        $flightClassDistribution = Flight::selectRaw('flight_class, count(*) as count')
            ->groupBy('flight_class')
            ->pluck('count', 'flight_class')
            ->toArray();

        // Airline distribution
        $airlineDistribution = Flight::selectRaw('airline_name, count(*) as count')
            ->groupBy('airline_name')
            ->pluck('count', 'airline_name')
            ->toArray();

        $stats['flight_class_distribution'] = $flightClassDistribution;
        $stats['airline_distribution'] = $airlineDistribution;

        return view('admin.FlightPanel', compact('flights', 'bookings', 'stats'));
    }

    public function create()
    {
        return view('admin.add-flight');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline_name' => 'required|string|max:255',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'departure_time_slot' => 'required|in:12am_6am,6am_12pm,12pm_6pm,6pm_12am',
            'arrival_time_slot' => 'required|in:12am_6am,6am_12pm,12pm_6pm,6pm_12am',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date|after:departure_date',
            'original_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0|lte:original_price',
            'available_seats' => 'required|integer|min:0',
            'airline_logo' => 'nullable|string',
            'flight_class' => 'required|in:Economy,Business,First',
            'baggage_allowance' => 'required|integer|min:0',
            'flight_number' => 'required|string|max:20|unique:flights,flight_number'
        ]);

        try {
            $flight = Flight::create($validated);

            Log::info('Flight created successfully', ['flight_id' => $flight->id]);
            return redirect()
                ->route('admin.flightpanel')
                ->with('success', 'Flight added successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating flight', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);
            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create flight. Please try again.']);
        }
    }

    public function updateStatus(FlightBooking $booking)
    {
        try {
            $booking->update(['payment_status' => 'paid']);
            
            Log::info('Flight booking status updated', ['booking_id' => $booking->id]);
            return back()->with('success', 'Booking status updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating flight booking status', [
                'error' => $e->getMessage(),
                'booking_id' => $booking->id
            ]);
            return back()->withErrors(['error' => 'Failed to update booking status.']);
        }
    }

    public function destroy(Flight $flight)
    {
        try {
            // Check if flight has any bookings
            if ($flight->bookings()->exists()) {
                return back()->withErrors(['error' => 'Cannot delete flight with existing bookings.']);
            }

            $flight->delete();
            
            Log::info('Flight deleted successfully', ['flight_id' => $flight->id]);
            return back()->with('success', 'Flight deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting flight', [
                'error' => $e->getMessage(),
                'flight_id' => $flight->id
            ]);
            return back()->withErrors(['error' => 'Failed to delete flight.']);
        }
    }

    public function sendNotification(Request $request, $bookingId)
    {
        try {
            $booking = FlightBooking::with('user')->findOrFail($bookingId);
        
            \Log::info('Flight notification request received:', [
                'booking_id' => $bookingId,
                'request_data' => $request->all()
            ]);

            $validated = $request->validate([
                'message' => 'required|string|max:500'
            ]);

            $notification = Notification::create([
                'user_id' => $booking->user->id,
                'message' => $validated['message']
            ]);

            \Log::info('Flight notification created:', [
                'notification_id' => $notification->id,
                'user_id' => $booking->user->id,
                'booking_id' => $bookingId
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Notification sent successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Flight notification error:', [
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