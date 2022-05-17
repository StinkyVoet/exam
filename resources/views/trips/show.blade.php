@extends('layouts.app')

@section('title', $trip->title)

@section('content')
    @include('components.header', ['height' => '300px'])
@endsection
