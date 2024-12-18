<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $setting = getSetting();
    @endphp

    <title>{{ $setting->app_name }}</title>
    <meta content="{{ $setting->description }}" name="description">
    <meta content="{{ $setting->keywords }}" name="keywords">
    <meta content="Tamus Tahir" name="author">

    <title>{{ $setting->app_name }}</title>
    <link href="{{ $setting->icon ? asset('storage/' . $setting->icon) : asset('backend/img/logo.png') }}"
        rel="icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        {!! Vite::content('resources/css/app.css') !!}
    </style>

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <img src="{{ $setting->icon ? asset('storage/' . $setting->icon) : asset('backend/img/logo.png') }}"
                    alt="" width="100">
            </a>
        </div>

        <p class="text-xl font-extrabold mt-3">{{ $setting->login_title }}</p>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <script>
        {!! Vite::content('resources/js/app.js') !!}
    </script>

</body>

</html>
