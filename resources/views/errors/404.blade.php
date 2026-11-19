@extends('layouts.app')

@section('title', 'Page not found — Etech')

@section('content')
    <main class="error-page">
        <div class="error-card">
            <a href="{{ url('/') }}" class="logo">{{ config('etech.brand') }}</a>
            <p class="error-code">404</p>
            <h1>This page took a different course</h1>
            <p class="error-text">The page you're looking for doesn't exist or has moved. Let's get you back to learning.</p>
            <a href="{{ rtrim(url('/'), '/') }}/" class="btn btn-primary">Back to home</a>
        </div>
    </main>
@endsection
