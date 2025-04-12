<?php



use App\Http\Controllers\User\CalendarController;

use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'auth'], function () {
    Route::resource('user-calendar', CalendarController::class);
});
