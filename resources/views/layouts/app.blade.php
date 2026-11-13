<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Etech. — Develop your skills in a new and unique way')</title>
    <meta name="description" content="{{ config('etech.hero.text') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @yield('content')

    @if (app()->isLocal() && request()->has('ref') && file_exists(public_path('reference/design.webp')))
        {{-- Dev-only: overlay the original design to compare pixel alignment (?ref=desktop|mobile). --}}
        <div id="ref-overlay" data-mode="{{ request('ref') }}"></div>
    @endif
</body>
</html>
