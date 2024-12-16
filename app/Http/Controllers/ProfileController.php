<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\BusBooking; // Add this import

class ProfileController extends Controller
{
    public function userprofile(): View
    {
        // Get bus bookings for the authenticated user
        $busBookings = BusBooking::where('user_id', Auth::id())->get();
        
        // Pass the bookings to the view
        return view('userprofile', compact('busBookings'));
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
}