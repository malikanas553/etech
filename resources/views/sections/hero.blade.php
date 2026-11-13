@php $hero = config('etech.hero'); @endphp
<section class="container-x hero-grid">
    <div class="hero-copy">
        {{-- The mobile design writes "new & unique way". --}}
        <h1>Develop your skills in a new <span class="only-desktop">and</span><span class="only-mobile">&amp;</span> unique way</h1>
        <p>{{ $hero['text'] }}</p>
        <div class="hero-actions">
            <a href="#courses" class="btn btn-primary">{{ $hero['cta'] }}</a>
            <a href="#" class="play-link">
                <span class="play-icon"><x-icon name="play" :size="14" /></span>
                {{ $hero['video'] }}
            </a>
        </div>
    </div>

    <div class="hero-art">
        <div class="hero-ring"><div class="hero-circle"></div></div>
        <img class="hero-girl" src="{{ asset('images/hero.webp') }}" alt="Smiling student holding books" fetchpriority="high">

        <div class="float-card fc-courses">
            <span class="ico"><x-icon name="cursor" :size="16" /></span>
            <div>
                <div class="fc-value">{{ $hero['courses']['value'] }}</div>
                <div class="fc-label">{{ $hero['courses']['label'] }}</div>
            </div>
        </div>

        <div class="float-card fc-students">
            <div class="fc-value">{{ $hero['students']['value'] }}</div>
            <div class="fc-label">{{ $hero['students']['label'] }}</div>
            <div class="avatars">
                @foreach ([1, 3, 5, 4] as $a)
                    <img src="{{ asset("images/avatar-$a.webp") }}" alt="">
                @endforeach
            </div>
        </div>

        <div class="float-card fc-class">
            <div class="row">
                <img src="{{ asset('images/avatar-6.webp') }}" alt="">
                <div>
                    <div class="t">{{ $hero['class']['title'] }}</div>
                    <div class="s">{{ $hero['class']['time'] }}</div>
                </div>
            </div>
            <a href="#" class="btn btn-primary">{{ $hero['class']['cta'] }}</a>
        </div>
    </div>
</section>
