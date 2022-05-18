<div class="navbar">
    <nav class="nav">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            @endguest
            @auth
            <li><a href="{{ route('trips.index') }}">Reizen</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
            @endauth
        </ul>
    </nav>
</div>
