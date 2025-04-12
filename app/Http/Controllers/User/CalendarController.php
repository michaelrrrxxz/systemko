<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $event->start_time,
                'end' => $event->end_time,
            ];
        });

        return inertia('User/Calendar', [
            'venues' => Venue::all(),
            'events' => $events, // Pass formatted events to the frontend
        ]);
    }
}
