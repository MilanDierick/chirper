<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Scrolling Banner -->
    @if(request()->routeIs('events.index'))
        <x-scrolling-banner :images="[
                    'https://via.placeholder.com/200x200?text=Slide+1',
                    'https://via.placeholder.com/800x200?text=Slide+2',
                    'https://via.placeholder.com/800x200?text=Slide+3',
                    'https://via.placeholder.com/800x200?text=Slide+4',
                ]"/>
    @endif

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const banner = document.querySelector('.scrolling-banner-inner');
        if (banner) {
            const imageCount = banner.children.length / 2; // since images are doubled
            banner.style.setProperty('--image-count', imageCount);
            banner.style.animationDuration = `${imageCount * 5}s`;
        }
    });
</script>
</body>
</html>
