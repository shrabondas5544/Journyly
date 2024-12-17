<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusBookingController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/train', function () {
    return view('train');
});

//
Route::middleware(['auth'])->group(function () {
    // User profile routes
    Route::get('/account/userprofile', [ProfileController::class, 'userprofile'])
        ->name('account.userprofile');
        
    Route::put('/account/update-profile', [ProfileController::class, 'update'])
        ->name('account.update-profile');
        
    // Bus booking routes    
    Route::delete('/account/bus-booking/{id}', [ProfileController::class, 'deleteBusBooking'])
        ->name('account.delete-bus-booking');
        
    // flight booking routes    
    Route::delete('/account/flight-booking/{id}', [ProfileController::class, 'deleteFlightBooking'])
        ->name('account.delete-flight-booking')
        ->middleware('auth');
});

//flight-------------------------------------------------------------------------------------------------------------------
Route::get('/account/flight', [FlightController::class, 'index'])->name('account.flight.index');
Route::get('/account/flight/search', [FlightController::class, 'search'])->name('account.flight.search');
Route::get('/flight/book/{id}', [FlightBookingController::class, 'show'])
    ->name('flight.book')
    ->middleware('auth');

Route::post('/flight/book/{id}', [FlightBookingController::class, 'store'])
    ->name('flight.book.store')
    ->middleware('auth');

//bus---------------------------------------------------------------------------------------------------------------------------------
Route::get('/account/bus', [BusController::class, 'index'])->name('account.bus.index');
Route::get('/account/bus/search', [BusController::class, 'search'])->name('account.bus.search');
Route::get('/bus/book/{id}', [BusBookingController::class, 'show'])
    ->name('bus.book')
    ->middleware('auth');
Route::post('/bus/book/{id}', [BusBookingController::class, 'store'])
    ->name('bus.book.store')
    ->middleware('auth');

//user---------------------------------------------------------------------------------------------------------------------------------
Route::get('/account/login',[LoginController::class,'index'])->name('account.login');
Route::get('/account/register',[LoginController::class,'register'])->name('account.register');
Route::post('/account/process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
Route::post('/account/logout', [LoginController::class, 'logout'])->name('account.logout');
//--------------------------------------------------------------------------------------------------------------------------------------
Route::post('/account/authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
Route::get('/account/dashboard',[DashboardController::class,'index'])->name('account.dashboard');

//terms and privacy
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

// feedback
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest admin routes
    Route::middleware(['guest:admin'])->group(function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('authenticate');
    });

    // Protected admin routes
    Route::middleware(['auth:admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
        
        // Feedback management
        Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
        Route::patch('/feedback/{feedback}/status', [FeedbackController::class, 'updateStatus'])->name('feedback.update-status');
        Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.delete');
    });
});

