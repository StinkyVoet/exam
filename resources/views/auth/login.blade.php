@extends('layouts.app')

@section('content')
    <div class="login-container">
        <form action="{{ route('login.post') }}" method="post" class="loginform">
            @csrf
            <div>
                <label for=""></label>
                <input type="text">
            </div>
            <div>
                <label for=""></label>
                <input type="text">
            </div>
            <div>
                <label for=""></label>
                <input type="text">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection
