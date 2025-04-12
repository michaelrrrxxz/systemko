<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin']], function () {
    require __DIR__ . '/admin.php'; // Admin-specific routes
});

Route::group(['middleware' => ['role:user']], function () {
    require __DIR__ . '/user.php'; // User-specific routes
});

require __DIR__ . '/auth.php'; // Authentication routes (accessible to all)

