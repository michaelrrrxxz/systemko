<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Venue;
use Illuminate\Http\Request;
Use App\Http\Requests\Admin\Venue\StoreRequest;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venue = Venue::all();
        return inertia('Admin/Venues', [
            'venues' => $venue,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated= $request->validated();
        Venue::create($validated);
        return redirect()->route('venues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venue $venue)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venue $venue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venue = Venue::findOrFail($id);
        $venue->delete();
        return redirect()->back()->with('success', 'Venue deleted successfully!');
    }
}
