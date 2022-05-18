@extends('layouts.app')

@section('content')
    <x-header height="350px" title="Reis aanmaken" undertitle=""/>
    <div class="item-actions">
        <a href="{{ route('trips.index') }}" class="btn btn-secondary">Terug</a>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form action="{{ route('trips.store') }}" method="post" class="form" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <div>
                    <label for="title">Titel</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div>
                    <label for="destination">Bestemming</label>
                    <input type="text" id="destination" name="destination" value="{{ old('destination') }}" required>
                </div>
            </div>
            <div class="input-group">
                <div>
                    <label for="start_date">Begindatum</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                </div>
                <div>
                    <label for="end_date">Einddatum</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                </div>
            </div>
            <div>
                <label for="max_registrations">Maxmimum aantal inschrijvingen</label>
                <input type="number" min="1" id="max_registrations" name="max_registrations" value="{{ old('max_registrations') }}" required>
            </div>
            <div>
                <label for="img">Foto <small>(optioneel)</small></label>
                <input type="file" name="img" id="img" accept="image/png, image/jpeg, image/jpg, image/webp">
            </div>
            <div>
                <label for="description">Omschrijving</label>
                <x-ck-editor.classic name="description" required="true">
                    {{ old('description') }}
                </x-ck-editor.classic>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Aanmaken</button>
            </div>
        </form>
    </div>
@endsection
