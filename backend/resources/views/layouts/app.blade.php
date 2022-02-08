<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <!-- FontAwesome -->
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

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
