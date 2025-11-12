<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Bus\BusController;
use App\Http\Controllers\Admin\Bus\BusTypeController;
use App\Http\Controllers\Admin\Bus\SeatLayoutController;
use App\Http\Controllers\Admin\Booking\BookingController;
// use App\Http\Controllers\Admin\Booking\PaymentController;
use App\Http\Controllers\Admin\Booking\ReportController;
/*
|---------------------------------------------------------------------------
| Public Routes (Guest Only)
|---------------------------------------------------------------------------
*/

// Landing page visible to all guests
Route::get('/', [AuthController::class, 'landing'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login_post', [AuthController::class, 'login_post'])->name('login_post');

    // Register page
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'register_post'])->name('register_post');
});

/*
|---------------------------------------------------------------------------
| Authenticated Users (Logout)
|---------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|---------------------------------------------------------------------------
| Admin Routes
|---------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('admin')->group(function () {
    // Admin Dashboard
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Bus Management
    Route::resource('buses', BusController::class, [
        'names' => [
            'index' => 'admin.buses.index',
            'create' => 'admin.buses.create',
            'store' => 'admin.buses.store',
            'show' => 'admin.buses.show',
            'edit' => 'admin.buses.edit',
            'update' => 'admin.buses.update',
            'destroy' => 'admin.buses.destroy',
        ]
    ]);

    // Bus Types Management
    Route::resource('bus-types', BusTypeController::class, [
        'names' => [
            'index' => 'admin.bus-types.index',
            'create' => 'admin.bus-types.create',
            'store' => 'admin.bus-types.store',
            'edit' => 'admin.bus-types.edit',
            'update' => 'admin.bus-types.update',
            'destroy' => 'admin.bus-types.destroy',
        ]
    ]);

    // Seat Layout Management
    Route::resource('seat-layouts', SeatLayoutController::class, [
        'names' => [
            'index' => 'admin.seat-layouts.index',
            'create' => 'admin.seat-layouts.create',
            'store' => 'admin.seat-layouts.store',
            'edit' => 'admin.seat-layouts.edit',
            'update' => 'admin.seat-layouts.update',
            'destroy' => 'admin.seat-layouts.destroy',
        ]
    ]);

    /*
    |---------------------------------------------------------------------------
    | Booking Management Routes
    |---------------------------------------------------------------------------
    */

    // All Bookings (View, Edit, Delete)
    Route::resource('bookings', BookingController::class, [
        'names' => [
            'index' => 'admin.bookings.index',      // List all bookings
            'create' => 'admin.bookings.create',    // Create new booking
            'store' => 'admin.bookings.store',      // Store new booking
            'show' => 'admin.bookings.show',        // View specific booking
            'edit' => 'admin.bookings.edit',        // Edit booking
            'update' => 'admin.bookings.update',    // Update booking
            'destroy' => 'admin.bookings.destroy',  // Delete booking
        ]
    ]);
    // Completed Bookings
    Route::get('booking/status/completed', [BookingController::class, 'completed'])->name('admin.bookings.completed');

    // Add the pending bookings route
    Route::get('booking/status/pending', [BookingController::class, 'pending'])->name('admin.bookings.pending');

    // Cancelled Bookings (View and Manage)
    Route::get('booking/status/cancelled', [BookingController::class, 'cancelled'])->name('admin.bookings.cancelled');

    // Reports (Booking Reports, Revenue, etc.)
    Route::get('bookings/reports', [ReportController::class, 'bookingReports'])->name('admin.bookings.reports');

    // Notifications (Manage and Resend Booking Notifications)
    Route::get('bookings/notifications', [BookingController::class, 'notifications'])->name('admin.bookings.notifications');
});

/*
|---------------------------------------------------------------------------
| User Routes
|---------------------------------------------------------------------------
*/
Route::middleware('user')->group(function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
});
