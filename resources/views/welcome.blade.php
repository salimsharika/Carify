<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carify</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-color: greenyellow;
            /* background-color: orange; */
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            font-size: 2.5rem;
            color: black;
        }
        header p {
            font-size: 1.2rem;
            color: black;
        }
        nav {
            margin-top: 20px;
        }
        nav a {
            text-decoration: none;
            color: #fff;
            background-color: #4caf50;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 0 10px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        nav a:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Carify</h1>
        <p>Your one-stop solution to manage car information</p>
    </header>
    <nav>
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log In</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </nav>
</body>
</html>
