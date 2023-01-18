<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/atlantis.min.css') }}">
</head>

<body
    style="background: rgb(131,58,180);
background: radial-gradient(circle, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 64%, rgba(252,176,69,1) 100%);">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg"
            style="background: rgb(0,0,0);
        background: radial-gradient(circle, rgba(0,0,0,1) 0%, rgba(94,90,90,1) 100%);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/login') }}" style="color: white">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <div class="navbar" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        @auth
                                <a href="{{ route('logout') }}" style="color: white"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>

</html>
