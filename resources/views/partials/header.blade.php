<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="margin-bottom: 20px;">
    <a class="navbar-brand" href="{{route('home')}}">My Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
            aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
        <ul class="navbar-nav mr-auto">
            @guest
                <li class="nav-item @yield('registerActive')">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                <li class="nav-item @yield('loginActive')">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users.show')}}">Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown04"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Parameters</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Account</a>
                        <a class="dropdown-item" href="#">Others</a>
                    </div>
                </li>-->
                <li class="nav-item">
                    <a class="nav-link"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endguest
        </ul>
        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search">
        </form>
    </div>
</nav>