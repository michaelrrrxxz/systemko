<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{LoginController, ForgotPasswordController};
use App\Http\Controllers\LandingPageController;
route::group(['middleware' => 'guest'], function () {
        route::get('/', [LandingPageController::class, 'index'])->name('/');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

});

Route::group(['middleware' => 'auth'], function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
