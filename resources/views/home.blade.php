@extends('layouts.app')

@section('content')
    <header class="hero">
        @include('sections.navbar')
        @include('sections.hero')
    </header>

    <main>
        @include('sections.partners')
        @include('sections.search')
        @include('sections.benefits')
        @include('sections.courses')
        @include('sections.instructor')

        <div class="grad-stack">
            @include('sections.testimonials')
            @include('sections.subscribe')
            @include('sections.footer')
        </div>
    </main>
@endsection
