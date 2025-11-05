<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusTypeController; // ⬅️ Add this import

Route::get('/', [AuthController::class, 'login']);
Route::post('login_post', [AuthController::class, 'login_post'])->name('login_post');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard']);

    /* Bus Management */
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

    /* Bus Types Management */
    Route::prefix('admin')->middleware('admin')->group(function () {

        // Bus Types CRUD
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
    });
});


Route::group(['middleware' => 'user'], function () {
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
});

Route::get('logout', [AuthController::class, 'logout']);
