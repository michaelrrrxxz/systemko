<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'userCount' => User::count(),
            'title' => 'Admin Dashboard',
        ]);
    }
}
