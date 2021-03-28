<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}" />
</head>
<body>
    <header class="header-container relative">
        <div class="header-image absolute"></div>
        <div class="header-content flex flex-col centering">
            <div class="header-topic">
                <h1 class="text-white text-center">Lorem, ipsum.</h1>
                <p class="text-white text-center font-bold">Lorem ipsum dolor sit amet?</p>
            </div>
            <div class="alt-btn flex centering mobile-nav-open-btn">
                <span class="nav-control-btn text-white">Find now!</span>
            </div>
        </div>
        <div class="navigation-container mt-20">
            <nav>
                <ul class="flex space-between nav-ul">
                    <li class="mb-20 mobile-nav-close-btn">
                        <i class="fas fa-times-circle nav-control-btn"></i>
                    </li>
                    <li><a class="font-bold nav-link" href="/">All</a></li>
                    <li><a class="font-bold nav-link" href="/campings/top">Top Rated</a></li>
                    <li><a class="font-bold nav-link" href="/campings/latest">Latest</a></li>
                    <li><a class="font-bold nav-link" href="/contacts">Contacts</a></li>
                    @auth
                    <li><a class="font-bold nav-link" href="/admin/all">Admin</a></li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>
    <div id="app" class="p-20">
        @yield('content')
    </div>
    <footer class="footer-container">
        <div class="footer-nav flex flex-col centering">
            <a href="/">All Campings</a>
            <a href="/campings/top">Top Rated</a>
            <a href="/campings/latest">Latest Ones</a>
            <a href="/contacts">Contact Us</a>
            @auth
            <a href="/logout">Logout</a>
            @else
            <a href="/login">Login</a>
            @endauth
        </div>
    </footer>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>