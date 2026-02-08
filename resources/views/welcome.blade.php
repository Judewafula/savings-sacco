<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Savings Sacco</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Your custom stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Laravel compiled CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: blue;
            margin: 0;
            padding: 0;
        }

        .my-class3 a {
            background-color: green;
            color: white;
            display: block;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            margin: 40px auto;
            width: 200px;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            transition: 0.2s ease-in-out;
        }

        .my-class3 a:hover {
            font-size: 32px;
            color: purple;
        }

        .banner {
            background-image: url('/images/banner.jpg');
            background-size: cover;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            margin: 30px auto;
            width: 60%;
            padding: 20px;
            color: maroon;
            border-radius: 10px;
            text-shadow: 2px 3px red;
        }
    </style>

</head>

<body>

    <div class="my-class">

        @if(Route::has('login'))
            <div class="my-class3">
                @auth
                    <a href="{{ route('dashboard') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if(Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="banner">
            <h2>Welcome to our Real-Time Stock Tracking (RTST)</h2>
        </div>

    </div>

</body>
</html>
