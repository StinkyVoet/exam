@extends('layouts.app')

@section('title', 'Reizen')

@section('content')
    @include('components.header')
    <div class="container">
        @if(auth()->user()->is_admin)
            <a href="{{ route('trips.create') }}" class="btn btn-primary">Reis aanmaken</a>
        @endif
        <div class="trips-wrapper">
            @foreach ($trips as $trip)
                <div class="trip">
                    <h4><a href="{{ route('trips.show', $trip) }}">{{ $trip->title }}</a></h4>
                </div>
            @endforeach
        </div>
    </div>
@endsection
