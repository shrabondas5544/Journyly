<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BusBooking;
use App\Models\FlightBooking;
use App\Models\TrainBooking;
use App\Models\HotelBooking;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_bookings' => BusBooking::count() + FlightBooking::count(),
            'total_revenue' => BusBooking::where('payment_status', 'paid')->sum('total') + 
                             FlightBooking::where('payment_status', 'paid')->sum('total'),
            'recent_feedbacks' => Feedback::where('created_at', '>=', now()->subDays(7))->count()
        ];

        $recentBookings = DB::query()
            ->fromSub(function($query) {
                $query->from('bus_bookings')
                    ->select('user_name', 'from_location', 'to_location', 'total as amount', 
                            'payment_status as status', DB::raw("'Bus' as type"), 'created_at')
                    ->union(
                        DB::table('flight_bookings')
                            ->select('user_name', 'from_location', 'to_location', 'total as amount', 
                                    'payment_status as status', DB::raw("'Flight' as type"), 'created_at')
                    );
            }, 'bookings')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Booking type statistics
        $bookingStats = [
            'Bus' => BusBooking::count(),
            'Flight' => FlightBooking::count(),
            'Train' => 0, // For future implementation
            'Hotel' => 0  // For future implementation
        ];

        return view('admin.dashboard', compact('stats', 'recentBookings', 'bookingStats'));
    }
}