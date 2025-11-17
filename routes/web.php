<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Bus\BusController;
use App\Http\Controllers\Admin\Bus\BusTypeController;
use App\Http\Controllers\Admin\Bus\SeatLayoutController;
use App\Http\Controllers\Admin\Booking\BookingController;
use App\Http\Controllers\Admin\Booking\ReportController;
use App\Http\Controllers\Admin\User\UserManagementController;
use App\Http\Controllers\Admin\Trip\RouteController;
use App\Http\Controllers\Admin\Trip\TripController;
use App\Http\Controllers\Admin\Trip\AssignBusController;
use App\Http\Controllers\Admin\Trip\FareController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest Only)
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'landing'])->name('landing');

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login_post', [AuthController::class, 'login_post'])->name('login_post');

  Route::get('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/register_post', [AuthController::class, 'register_post'])->name('register_post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Users (Logout)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('admin')->group(function () {

  /*
  |--------------------------------------------------------------------------
  | Dashboard Routes
  |--------------------------------------------------------------------------
  */
  Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

  /*
  |--------------------------------------------------------------------------
  | Bus Management
  |--------------------------------------------------------------------------
  */
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
  |--------------------------------------------------------------------------
  | Booking Management
  |--------------------------------------------------------------------------
  */
  Route::prefix('bookings')->group(function () {

    // CRUD
    Route::resource('/', BookingController::class, [
      'names' => [
        'index' => 'admin.bookings.index',
        'create' => 'admin.bookings.create',
        'store' => 'admin.bookings.store',
        'show' => 'admin.bookings.show',
        'edit' => 'admin.bookings.edit',
        'update' => 'admin.bookings.update',
        'destroy' => 'admin.bookings.destroy',
      ]
    ])->parameters(['' => 'booking']); // Fix route parameter naming

    // Status Views
    Route::get('status/pending', [BookingController::class, 'pending'])->name('admin.bookings.status.pending');
    Route::get('status/completed', [BookingController::class, 'completed'])->name('admin.bookings.status.completed');
    Route::get('status/cancelled', [BookingController::class, 'cancelled'])->name('admin.bookings.status.cancelled');

    // Reports
    Route::get('reports', [ReportController::class, 'bookingReports'])->name('admin.bookings.reports');

    // Notifications
    Route::get('notifications', [BookingController::class, 'notifications'])->name('admin.bookings.notifications');
  });

  /*
  |--------------------------------------------------------------------------
  | Trip / Route Management
  |--------------------------------------------------------------------------
  */
  Route::prefix('Trip_Route Management-management')->group(function () {

    /* ------------------ ROUTES MANAGEMENT ------------------ */
    Route::resource('routes', \App\Http\Controllers\Admin\Trip\RouteController::class, [
      'names' => [
        'index' => 'admin.routes.index',
        'create' => 'admin.routes.create',
        'store' => 'admin.routes.store',
        'edit' => 'admin.routes.edit',
        'update' => 'admin.routes.update',
        'destroy' => 'admin.routes.destroy',
      ]
    ]);

    /* ------------------ TRIPS / SCHEDULES ------------------ */
    Route::resource('trips', \App\Http\Controllers\Admin\Trip\TripController::class, [
      'names' => [
        'index' => 'admin.trips.index',
        'create' => 'admin.trips.create',
        'store' => 'admin.trips.store',
        'edit' => 'admin.trips.edit',
        'update' => 'admin.trips.update',
        'destroy' => 'admin.trips.destroy',
      ]
    ]);


    /* ------------------ ASSIGN BUS TO TRIP ------------------ */
    Route::get('assign', [\App\Http\Controllers\Admin\Trip\AssignBusController::class, 'index'])
      ->name('admin.assign.index');

    Route::post('assign', [\App\Http\Controllers\Admin\Trip\AssignBusController::class, 'assign'])
      ->name('admin.assign.store');


    /* ------------------ FARE MANAGEMENT ------------------ */
    Route::resource('fares', \App\Http\Controllers\Admin\Trip\FareController::class, [
      'names' => [
        'index' => 'admin.fares.index',
        'create' => 'admin.fares.create',
        'store' => 'admin.fares.store',
        'edit' => 'admin.fares.edit',
        'update' => 'admin.fares.update',
        'destroy' => 'admin.fares.destroy',
      ]
    ]);
  });

    /*
  |--------------------------------------------------------------------------
  | User Management
  |--------------------------------------------------------------------------
    */
  Route::prefix('users')->name('admin.')->group(function () {

    // Custom pages first (avoid conflict with resource routes)
    Route::get('roles', [UserManagementController::class, 'roles'])->name('user-roles.index');
    Route::put('roles/{user}', [UserManagementController::class, 'updateRole'])->name('user-roles.update');
    Route::get('activity', [UserManagementController::class, 'activity'])->name('users.activity');
    Route::get('blocked', [UserManagementController::class, 'blocked'])->name('users.blocked');
    Route::get('bulk', [UserManagementController::class, 'bulk'])->name('users.bulk');

    // CRUD for Users
    Route::resource('/', UserManagementController::class)
      ->except(['show'])
      ->names([
        'index' => 'users.index',
        'create' => 'users.create',
        'store' => 'users.store',
        'edit' => 'users.edit',
        'update' => 'users.update',
        'destroy' => 'users.destroy',
      ])
      ->parameters(['' => 'user']);
  });
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('user')->group(function () {
  Route::get('user/dashboard', [DashboardController::class, 'dashboard'])->name('user.dashboard');
});
