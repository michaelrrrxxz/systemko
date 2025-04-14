<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::resource('dashboard', DashboardController::class)->only(['index']);

Route::group(['middleware' => ['role:super-user|admin']], function () {
    require __DIR__ . '/admin.php';
});

Route::group(['middleware' => ['role:super-user|user']], function () {
    require __DIR__ . '/user.php';
});

require __DIR__ . '/auth.php';

