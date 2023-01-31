<nav class="navbar navbar-expand-md navbar-light bg-warning shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" target="_blank">
            <div class="logo_laravel text-white">
                Portfolio
            </div>
            {{-- config('app.name', 'Laravel') --}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/')}}" target="_blank">Vedi il sito</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>


                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
