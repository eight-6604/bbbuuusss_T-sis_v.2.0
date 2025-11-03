<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', [AuthController::class,'login']);
Route::post('login_post', [AuthController::class,'login_post'])->name('login_post');


Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class,'dashboard']);
});

Route::group(['middleware' => 'user'], function() {
    Route::get('user/dashboard', [DashboardController::class,'dashboard']);
});

Route::get('logout',[AuthController::class,'logout']);
