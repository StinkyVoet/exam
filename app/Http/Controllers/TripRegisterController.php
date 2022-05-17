<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripRegisterController extends Controller
{
    public function register(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'identity_number' => 'required|string',
            'comment' => 'string'
        ]);

        // Check of max inschrijvingen is behaald
        if($trip->hasMaxRegistrants) {
            return redirect()->back()->withErrors(['msg', 'Het maximaal aantal inschrijvingen is al behaald']);
        }

        $trip->registrants()->attach(auth()->id(), [
            'identity_number' => $validated['identity_number'],
            'comment' => $validated['comment']
        ]);

        return redirect()->back();
    }

    public function unregister(Trip $trip)
    {
        // check of geregistreerd


        // check of het meer dan een week vantevoren is
    }
}
