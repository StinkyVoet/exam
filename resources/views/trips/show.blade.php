@extends('layouts.app')

@section('title', $trip->title)

@section('content')
    <x-header height="350px" :title="$trip->title" :undertitle="'Bestemming: '.$trip->destination" :img="$trip->img"/>
    <div class="item-actions">
        <a href="{{ route('trips.index') }}" class="btn btn-secondary">Terug</a>
        @if(auth()->user()->is_admin)
                <a href="{{ route('trips.edit', $trip) }}" class="btn btn-primary">Aanpassen</a>
                <form action="{{ route('trips.destroy', $trip) }}" method="post">@csrf @method('delete')<button type="submit" class="btn btn-danger">Verwijderen</button></form>
        @endif
    </div>
    <div class="container">
        <p>{!! $trip->description !!}</p>
        <br>
        <p>Begindatum: {{ $trip->start_date->format("l, d F Y") }}</p>
        <p>Einddatum: {{ $trip->end_date->format("l, d F Y") }}</p>
        <br>

        <p>Aantal inschrijvingen: {{ $trip->registrants->count() }}/{{ $trip->max_registrations }}</p>
        @if(auth()->user()->is_admin)
            @foreach ($trip->registrants as $student)
                @if ($loop->first)
                    <ul>
                @endif
                <li>
                    <p>{{ $student->name }}</p>
                    <p>Nummer identiteitsbewijs: {{ $student->pivot->identity_number }}</p>
                    <p>Opmerkingen: {!! $student->pivot->comment !!}</p>
                </li>
                @if ($loop->last)
                    </ul>
                @endif
            @endforeach
        @else
        {{-- Errors In/Uitschrijven --}}
        @if ($errors->has('registration'))
                <div class="alert alert-danger">
                    <div>{{ $errors->get('registration')[0] }}</div>
                </div>
            @endif

            @if (auth()->user()->hasTrip($trip))
                <a href="{{ route('trips.unregister', $trip) }}" class="btn btn-primary">Uitschrijven</a>
            @else
                @if(!$trip->hasMaxRegistrants || auth()->user()->hasTrip($trip))
                    <form action="{{ route('trips.register', $trip) }}" method="post" class="form">
                        @csrf
                        <input type="text" name="identity_number" id="identity_number" placeholder="Identiteitsbewijs nummer" value="{{ old('identity_number') }}" required>
                        <x-ck-editor.classic name="comment" placeholder="Opmerkingen (denk aan dieet, lichamelijke klachten)">
                            {{ old('comment') }}
                        </x-ck-editor.classic>
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
