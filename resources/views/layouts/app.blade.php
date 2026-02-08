<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Home') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
<div id="app">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid px-4">
           <a href="{{ url('/home') }}" class="btn btn-primary p-1">
    <img src="{{ asset('images/cock.jpg') }}" alt="Cock Icon" style="height:30px; width:auto;">
</a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">

                    <!-- Menu Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button"
                           data-bs-toggle="dropdown">
                            Menu
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('sales.index') }}">Sales List</a></li>
                            <li><a class="dropdown-item" href="{{ route('sales.create') }}">Create Sale</a></li>
                            <li><a class="dropdown-item" href="{{ route('assets.index') }}">View Assets</a></li>
                            <li><a class="dropdown-item" href="{{ route('assets.dashboard') }}">Go to Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('profit') }}">Profit Summary</a></li>
                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    <!-- User Dropdown -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mt-5 pt-4">
        @yield('content')
    </main>

</div>

<!-- Warning Message (Inside HTML, Not After) -->
@if(session('warning'))
    <div id="warning-alert"
         style="background-color:#ffcccb;padding:15px;color:red;border:1px solid red; margin:20px;">
        🔒 {{ session('warning') }}
    </div>

    <audio id="warning-sound" autoplay>
        <source src="{{ asset('sounds/warning.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        setTimeout(() => {
            let alert = document.getElementById('warning-alert');
            if (alert) alert.style.display = 'none';
        }, 5000);
    </script>
@endif

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div id="app" style="
    background-image: url('{{ asset('images/hen.jpg') }}');
    background-size: cover;
    background-position: center;
    min-height: 100vh;
    background-attachment: fixed;
">

</body>
</html>
