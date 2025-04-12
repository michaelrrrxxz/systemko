<?php



use App\Http\Controllers\Admin\{DashboardController,CalendarController,UserController,VenueController,EventContoller};

use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>'auth'], function () {
    Route::resource('users', UserController::class);
    Route::resource('dashboard', DashboardController::class)->only(['index']);
    Route::resource('venues', VenueController::class);
    Route::resource('calendar', CalendarController::class);
    route::resource('events', EventContoller::class)->only('index');

});
