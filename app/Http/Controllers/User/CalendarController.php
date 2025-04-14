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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'date' => 'required|date',
            'venue_id' => 'required|exists:venues,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Check for overlapping events
        $overlap = Event::where('venue_id', $request->venue_id)
            ->whereDate('start_time', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                    });
            })
            ->exists();

        if ($overlap) {
            return response()->json(['success' => false, 'message' => 'The selected time overlaps with another event.'], 400);
        }

        // Determine approval status based on user role
        $isAdmin = auth()->user()->hasRole('admin'); // Check if the user has the 'admin' role
        $approvedBy = $isAdmin ? auth()->id() : null; // Set approved_by if admin
        $approvedAt = $isAdmin ? now() : null; // Set approved_at if admin

        // Create the event
        $event = Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'venue_id' => $request->venue_id,
            'start_time' => $request->date . ' ' . $request->start_time,
            'end_time' => $request->date . ' ' . $request->end_time,
            'added_by' => auth()->id(), // Add the authenticated user's ID
            'approved_by' => $approvedBy, // Set approved_by if admin
            'approved_at' => $approvedAt, // Set approved_at if admin
        ]);

        return response()->json(['success' => true, 'event' => $event]);
    }
}
