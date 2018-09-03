@php
    $config = [
    ];
@endphp
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

@if(Route::has('login'))
    <div class="absolute pin-t pin-r mt-4 mr-4">
        @auth
            <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase">Home</a>
        @else
            <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase pr-6">Login</a>
            <a href="{{ route('register') }}" class="no-underline hover:underline text-sm font-normal text-teal-darker uppercase">Register</a>
        @endauth
    </div>
@endif

<div id="app"></div>

{{-- Global configuration object --}}
<script>window.config = @json($config);</script>

{{-- Load the application scripts --}}
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>