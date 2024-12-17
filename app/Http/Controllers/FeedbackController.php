<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the feedbacks.
     */
    public function index(): View
    {
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedbackview', compact('feedbacks'));
    }

    /**
     * Store a newly created feedback in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string'
        ]);

        $user = Auth::user();

        $feedback = new Feedback();
        $feedback->email = $request->email;
        $feedback->message = $request->message;
        $feedback->status = 'pending';
        
        if ($user) {
            $feedback->user_id = $user->id;
            $feedback->user_name = $user->name;
            $feedback->phone = $user->phone;
        } else {
            $feedback->user_name = 'Guest';
        }

        $feedback->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Thank you! Your feedback has been submitted successfully.'
        ], 200);
    }

    /**
     * Update the specified feedback status.
     */
    public function updateStatus(Feedback $feedback): RedirectResponse
    {
        $feedback->status = 'reviewed';
        $feedback->save();

        return back()->with('success', 'Feedback status updated successfully');
    }
}