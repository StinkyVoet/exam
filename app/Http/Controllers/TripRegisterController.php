<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class TripRegisterController extends Controller
{
    public function register(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'identity_number' => 'required|string',
            'comment' => 'string'
        ]);

        // Check of gebruiker al is geregistreerd
        if($trip->registrants->contains(auth()->id())) {
            return redirect()->back()->withErrors(['registration' => 'Je bent al ingeschreven voor deze reis']);
        }

        // Check of max inschrijvingen is behaald
        if($trip->hasMaxRegistrants) {
            return redirect()->back()->withErrors(['registration' => 'Het maximaal aantal inschrijvingen is al behaald']);
        }

        // Inschrijving invoeren
        $trip->registrants()->attach(auth()->id(), [
            'identity_number' => $validated['identity_number'],
            'comment' => $validated['comment']
        ]);

        return redirect()->back();
    }

    public function unregister(Trip $trip, MessageBag $message_bag)
    {
        // check of geregistreerd
        if(!$trip->registrants->contains(auth()->id())) {
            return redirect()->back()->withErrors(['registration' => 'Je bent niet ingeschreven voor deze reis']);
        }
        // check of het meer dan een week vantevoren is
        $weeksDiff = date_diff($trip->start_date, now())->days / 7;
        if($weeksDiff < 1) {
            return redirect()->back()->withErrors(['registration' => 'Vanaf een week vantevoren kan je niet meer uitschrijven']);
        }

        // inschrijving webhalen
        $trip->registrants()->detach(auth()->id());

        return redirect()->back();
    }
}
