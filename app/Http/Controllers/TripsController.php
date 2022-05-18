<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Haal alle reizen op
        $trips = Trip::all();

        return view('trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Trip $trip)
    {
        Gate::authorize('create', Trip::class);
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Trip::class);

        $validated = $request->validate([
            'title' => 'required|string',
            'destination' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'max_registrations' => 'required|integer|min:0|not_in:0',
            'img' => 'file|mimes:jpg,png,jpeg,webp|mimetypes:image/png,image/jpg,image/jpeg,image/webp',
        ]);

        // Check of er een file is geupload. Zoja, plaats het in een mapje
        if($request->hasFile('img')) {
            $path = $request->file('img')->store('upload/trips', 'public');
        }

        $trip = Trip::create([
            'title' => $validated['title'],
            'destination' => $validated['destination'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'max_registrations' => $validated['max_registrations'],
            'img' => $path ?? null,
        ]);

        return redirect(route('trips.show', $trip));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        Gate::authorize('update', Trip::class);
        return view('trips.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        Gate::authorize('update', Trip::class);

        $validated = $request->validate([
            'title' => 'required|string',
            'destination' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'max_registrations' => 'required|integer|min:0|not_in:0',
            'img' => 'file|mimes:jpg,png,jpeg,webp|mimetypes:image/png,image/jpg,image/jpeg,image/webp',
        ]);

        if($request->hasFile('img')) {
            if($trip->img) {
                $path = $request->file('img')->storeAs('upload/trips', $trip->img, 'public');
            } else {
                $path = $request->file('img')->store('upload/trips', 'public');
            }
        }

        $trip->title = $validated['title'];
        $trip->destination = $validated['destination'];
        $trip->description = $validated['description'];
        $trip->start_date = $validated['start_date'];
        $trip->end_date = $validated['end_date'];
        $trip->max_registrations = $validated['max_registrations'];
        $trip->img = $path ?? $trip->img;
        // Alleen opslaan als er data is veranderd
        $trip->isDirty() ? $trip->save() : null;

        return redirect(route('trips.show', $trip));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        Gate::authorize('delete', Trip::class);

        $trip->delete();
        return redirect(route('trips.index'));
    }
}
