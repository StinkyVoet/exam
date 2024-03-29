@extends('layouts.app')

@section('content')
    <div class="login-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        @endif
        <h2>Log in - Admin</h2>
        <form action="{{ route('admin.login.post') }}" method="post" class="loginform">
            @csrf
            <div>
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}">
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
