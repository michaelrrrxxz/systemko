
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{LoginController, ForgotPasswordController};

route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
});
