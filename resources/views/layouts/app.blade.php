<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @php
        $title = trim($__env->yieldContent('title', 'Etech. — Develop your skills in a new and unique way'));
        $description = 'Online courses in web design, UI/UX and data science taught by industry experts. 50+ courses, 1.5k+ video lessons and accredited online degrees — learn at your own pace with Etech.';
        $canonical = rtrim(url('/'), '/').'/';
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="theme-color" content="#b672ff">
    <meta name="color-scheme" content="light">

    {{-- Social sharing --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Etech">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Etech — Develop your skills in a new and unique way">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ asset('og-image.png') }}">

    {{-- Icons --}}
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Fonts: preconnect + swap so text shows immediately --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- The hero photo is the largest element on first paint --}}
    <link rel="preload" as="image" href="{{ asset('images/hero.webp') }}" fetchpriority="high">

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => 'Etech',
            'url' => $canonical,
            'logo' => asset('apple-touch-icon.png'),
            'description' => $description,
            'email' => config('etech.footer.email'),
            'telephone' => config('etech.footer.phone'),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

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
