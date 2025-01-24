<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="md:max-w-sm md:text-sm text-xs mx-auto bg-gray-800">
    <div class="bg-gray-200 min-h-screen">
        <header class="w-full flex justify-between bg-white shadow p-4 fixed md:max-w-sm">
            {{$header}}
            <section class="flex items-center">
                <x-application-logo width="60px" height="20px" />
            </section>
        </header>
        <main class="pt-5">
            {{$slot}}
        </main>
    </div>
    @if(request()->routeIs('profile.completation'))

    @else
    @include('layouts.navigation')
    @endif
    @stack('addedScript')
</body>
</html>
