@extends('layouts.app')

@section('content')
    <div class="login-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <form action="{{ route('login.post') }}" method="post" class="loginform">
            @csrf
            <div>
                <label for="email">E-mail adres</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div>
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="remember_me">Blijf ingelogd</label>
                <input type="checkbox" name="remember_me" id="remember_me">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <style>
        body {
            background: var(--color-secondary);
        }
    </style>
@endsection
