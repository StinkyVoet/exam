@extends('layouts.app')

@section('content')
    <x-header height="350px" title="{{ $trip->title }}" undertitle="Reis aanpassen"/>
    <div class="item-actions">
        <a href="{{ route('trips.show', $trip) }}" class="btn btn-secondary">Terug</a>
        @if(auth()->user()->is_admin)
                <form action="{{ route('trips.destroy', $trip) }}" method="post">@csrf @method('delete')<button type="submit" class="btn btn-danger">Verwijderen</button></form>
        @endif
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form action="{{ route('trips.update', $trip) }}" method="post" class="form" enctype="multipart/form-data">
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
                <label for="img">Foto <small>(optioneel)</small></label>
                <input type="file" name="img" id="img" accept="image/png, image/jpeg, image/jpg">
            </div>
            <div>
                <label for="description">Omschrijving</label>
                <x-ck-editor.classic name="description" required="true">{{ old('description') ?? $trip->description }}</x-ck-editor.classic>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Wijzigen</button>
            </div>
        </form>
    </div>
@endsection
