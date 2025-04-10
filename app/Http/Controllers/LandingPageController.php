<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;

class LandingPageController extends Controller
{
    public function index()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->name,
                'start' => $event->start_time,
                'end' => $event->end_time,
                'description' => $event->description,
                'venue_id' => $event->venue_id,
            ];
        });

        return inertia('LandingPage', [
            'venues' => Venue::all(), // Pass venues for filtering if needed
            'events' => $events, // Pass formatted events to the frontend
        ]);
    }
}
