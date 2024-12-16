<?php
namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\FlightBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\BusBooking; // Add this import

class ProfileController extends Controller
{
    public function userprofile(): View
    {
        // Get bus,flight bookings for the authenticated user
        $busBookings = BusBooking::where('user_id', Auth::id())->get();
        $flightBookings = FlightBooking::where('user_id', Auth::id())->get();
        
        // Pass the bookings to the view
        return view('userprofile', compact('busBookings','flightBookings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
            'address' => 'nullable|string|max:255',
            'sex' => 'nullable|in:male,female',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->sex = $request->sex;
        $user->save();

        return redirect()
            ->route('account.userprofile')
            ->with('success', 'Profile updated successfully!');
    }

    // Add method to handle bus booking deletion
    public function deleteBusBooking($id)
    {
        $booking = BusBooking::where('user_id', Auth::id())
                            ->where('id', $id)
                            ->firstOrFail();
                            
        $booking->delete();
        
        return redirect()
            ->route('account.userprofile')
            ->with('success', 'Booking deleted successfully!');
    }

    public function deleteFlightBooking($id)
    {
        $booking = FlightBooking::where('user_id', Auth::id())->findOrFail($id);
        $booking->delete();
        return back()->with('success', 'Flight booking deleted successfully.');
    }
}