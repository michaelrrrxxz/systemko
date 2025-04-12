<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
class EventContoller extends Controller
{
    public function index()
    {
        $events = Event::with('venue')->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'name' => $event->name,
                'start_time' => $event->start_time,
                'end_time' => $event->end_time,
                'venue' => $event->venue ? $event->venue->name : null,
                'added_by' => $event->user ? $event->user->name : null,
            ];
        });

        return inertia('Admin/Events', [
            'events' => $events,
        ]);
    }

}
