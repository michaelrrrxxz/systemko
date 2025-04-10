<?php

use App\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventContoller;



Route::group(['middleware' =>[ 'sleep','auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::resource('venues', VenueController::class);
    Route::resource('calendar', CalendarController::class);
    route::resource('events', EventContoller::class)->only('index');

});

Route::group(['middleware' => 'sleep'], function () {
    require __DIR__ . '/auth.php';
});

