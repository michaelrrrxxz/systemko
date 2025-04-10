<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
class DashboardController extends Controller
{
    public function index()
    {
        // Get the count of finished events
        $finishedEvents = Event::finished()->count();

        // Get the count of ongoing events
        $ongoingEvents = Event::ongoing()->count();

        // Get the count of future events
        $futureEvents = Event::future()->count();

        return inertia('Dashboard', [
            'userCount' => User::count(),
            'title' => 'Admin Dashboard',
            'finishedEvents' => $finishedEvents,
            'ongoingEvents' => $ongoingEvents,
            'futureEvents' => $futureEvents,
        ]);
    }


}
