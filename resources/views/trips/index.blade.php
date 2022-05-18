@extends('layouts.app')

@section('title', 'Reizen')

@section('content')
    <x-header />
    <div class="container">
        @if(auth()->user()->is_admin)
            <a href="{{ route('trips.create') }}" class="btn btn-primary">Reis aanmaken</a>
        @endif
        <div class="trips-wrapper">
            @foreach ($trips as $trip)
                <a href="{{ route('trips.show', $trip) }}" class="trip">
                    <img src="{{ asset($trip->img ? Storage::url($trip->img) : 'img/header.webp') }}" alt="">
                    <div class="text">
                        <h4>{{ $trip->title }}</h4>
                        <div>{!! Str::limit($trip->description, 100, '...') !!}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
