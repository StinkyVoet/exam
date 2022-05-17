@extends('layouts.app')

@section('title', $trip->title)

@section('content')
    <x-header height="300px" :title="$trip->title" :undertitle="'Bestemming: '.$trip->destination"/>
    <div class="item-actions">
        @if(auth()->user()->is_admin)
                <a href="{{ route('trips.edit', $trip) }}" class="btn btn-primary">Aanpassen</a>
                <form action="{{ route('trips.destroy', $trip) }}" method="post">@csrf @method('delete')<button type="submit" class="btn btn-danger">Verwijderen</button></form>
        @endif
    </div>
    <div class="container">
        <p>{{ $trip->description }}</p>
        <br>
        <p>Begindatum: {{ $trip->start_date->format("l, d F Y") }}</p>
        <p>Einddatum: {{ $trip->end_date->format("l, d F Y") }}</p>
        <br>

        <p>Aantal inschrijvingen: {{ $trip->registrants->count() }}/{{ $trip->max_registrations }}</p>
        @if(!auth()->user()->is_admin)
            {{-- Errors In/Uitschrijven --}}
            @if ($errors->hasBag('registration'))
                <div class="alert alert-danger">
                    <div>{{ $error->registration }}</div>
                </div>
            @endif
            @if (auth()->user()->hasTrip($trip))
                <a href="{{ route('trips.unregister', $trip) }}" class="btn btn-primary">Uitschrijven</a>
            @else
                @if(!$trip->hasMaxRegistrants || auth()->user()->hasTrip($trip))
                    <form action="{{ route('trips.register', $trip) }}" method="post" class="form">
                        @csrf
                        <input type="text" name="identity_number" id="identity_number" placeholder="Identiteitsbewijs nummer" value="{{ old('identity_number') }}" required>
                        <textarea name="comment" id="comment" rows="5" placeholder="Opmerkingen (denk aan dieet, lichamelijke klachten)" required>{{ old('comment') }}</textarea>
                        <button class="btn btn-primary" type="submit">Inschrijven</button>
                    </form>
                @else
                    <small>Het maximum aantal inschrijvingen zijn behaald. Je kan niet meer inschrijven.</small><br>
                    <button class="btn btn-primary disabled">Inschrijven</button>
                @endif
            @endif
        @endif
    </div>
@endsection
