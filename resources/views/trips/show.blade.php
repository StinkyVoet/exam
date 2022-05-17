@extends('layouts.app')

@section('title', $trip->title)

@section('content')
    <x-header height="300px" :title="$trip->title" :undertitle="$trip->destination"/>
    <div class="item-actions">
        @if(auth()->user()->is_admin)
                <a href="{{ route('trips.edit', $trip) }}">Aanpassen</a>
                <a href="{{ route('trips.destroy', $trip) }}">Verwijderen</a>
        @endif
    </div>
    <div class="container">
        <p>{{ $trip->description }}</p>
        <p>Aantal inschrijvingen: {{ $trip->registrants->count() }}/{{ $trip->max_registrations }}</p>
        @if(!auth()->user()->is_admin)
            @if (auth()->user()->hasTrip($trip))
                <a href="{{ route('trips.unregister', $trip) }}" class="btn btn-primary">Uitschrijven</a>
            @else
                <form @if(!$trip->hasMaxRegistrants || auth()->user()->hasTrip($trip))
                        action="{{ route('trips.register', $trip) }}"
                    @endif method="post" class="form">
                    @csrf
                    <input type="text" name="identity_number" id="identity_number" placeholder="Identiteitsbewijs nummer">
                    <textarea name="comment" id="comment" rows="5" placeholder="Opmerkingen (denk aan dieet, lichamelijke klachten)"></textarea>
                    <button @class([
                        "btn",
                        "btn-primary",
                        "disabled" => $trip->hasMaxRegistrants || auth()->user()->hasTrip($trip)
                    ]) type="submita">Inschrijven</button>
                </form>
            @endif
        @endif
    </div>
@endsection
