<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tamari-Ba') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

        <!-- Fonts -->
        <script rel="preload" src="https://kit.fontawesome.com/39c851380d.js" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link rel="stylesheet preload" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script rel="preload" src="{{ asset('js/app.js') }}" defer></script>

        <!-- FontAwesome -->
        <link rel="preload" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <!-- 画像遅延読み込み -->
        <script src="{{ asset('js/lazyload.min.js') }}" async></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @if (auth('admin')->user())
                @include('layouts.admin-navigation')
            @elseif(auth('owners')->user())
                @include('layouts.owner-navigation')
            @elseif(auth('users')->user())
                @include('layouts.user-navigation')
            @else
                @include('layouts.guest-navigation')
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
