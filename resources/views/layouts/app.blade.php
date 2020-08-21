<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>someBlog | @yield('header_title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if(!Auth::guest())
        <link href="{{ asset('css/main'.Auth::user()->theme.'.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/main0.css') }}" rel="stylesheet">
    @endif

    @yield('header_links')
</head>
<body>
    <div id="app">
        @include('layouts.navbar')
        @include('layouts.messages')
        <main class="container py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
