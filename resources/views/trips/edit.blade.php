@extends('layouts.app')

@section('content')
    <x-header height="300px" title="Reis aanmaken" undertitle=""/>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form action="{{ route('trips.update', $trip) }}" method="post" class="form">
            @csrf
            @method('put')
            <div class="input-group">
                <div>
                    <label for="title">Titel</label>
                    <input type="text" id="title" name="title" value="{{ old('title') ?? $trip->title }}" required>
                </div>
                <div>
                    <label for="destination">Bestemming</label>
                    <input type="text" id="destination" name="destination" value="{{ old('destination') ?? $trip->destination }}" required>
                </div>
            </div>
            <div class="input-group">
                <div>
                    <label for="start_date">Begindatum</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') ?? $trip->start_date->format('Y-m-d') }}" required>
                </div>
                <div>
                    <label for="end_date">Einddatum</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') ?? $trip->end_date->format('Y-m-d') }}" required>
                </div>
            </div>
            <div>
                <label for="max_registrations">Maxmimum aantal inschrijvingen</label>
                <input type="number" min="1" id="max_registrations" name="max_registrations" value="{{ old('max_registrations') ?? $trip->max_registrations }}" required>
            </div>
            <div>
                <label for="description">Omschrijving</label>
                <textarea name="description" id="description" rows="10" required>{{ old('description') ?? $trip->description }}</textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Wijzigen</button>
            </div>
        </form>
    </div>
@endsection
