@extends('layouts.app')

@section('content')
    <a href="#main" class="skip-link">Skip to content</a>

    <header class="site-nav-wrap" id="top">
        <div class="scroll-progress" aria-hidden="true"></div>
        @include('sections.navbar')
    </header>
    @include('sections.drawer')

    <main id="main">
        <section class="hero" aria-label="Introduction">
            @include('sections.hero')
        </section>
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

    <a href="#top" class="to-top" aria-label="Back to top" data-to-top><x-icon name="chevron-right" :size="18" /></a>
@endsection
