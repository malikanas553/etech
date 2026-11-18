@php $t = config('etech.testimonials'); $count = count($t['items']); @endphp
<section id="testimonials" class="testimonials" aria-labelledby="testimonials-title" aria-roledescription="carousel" data-deck>
    <div class="container-x">
        <h2 id="testimonials-title" class="section-title">{{ $t['title'] }}</h2>
        <p class="section-sub">{{ $t['text'] }}</p>

        {{-- Spotlight deck: the active card sits in front, neighbours fan out behind it. --}}
        <div class="t-stage" data-deck-stage aria-live="polite">
            @foreach ($t['items'] as $n => $item)
                <article class="t-card" data-deck-card aria-roledescription="slide" aria-label="{{ $n + 1 }} of {{ $count }}">
                    <svg class="t-quote" viewBox="0 0 48 36" aria-hidden="true"><path fill="currentColor" d="M0 36V22C0 9.6 6.5 2.3 19.4 0l2 4.6C14.5 6.7 11 10.9 10.6 17H20v19H0Zm28 0V22c0-12.4 6.5-19.7 19.4-22l2 4.6C42.5 6.7 39 10.9 38.6 17H48v19H28Z"/></svg>
                    <p>{{ $item['quote'] }}</p>
                    <div class="t-head">
                        <img src="{{ asset("images/{$item['avatar']}.webp") }}" alt="{{ $item['name'] }}" loading="lazy">
                        <div>
                            <div class="t-name">{{ $item['name'] }}</div>
                            <div class="t-role">{{ $item['role'] }}</div>
                        </div>
                        <div class="stars" role="img" aria-label="5 out of 5 stars">@for ($i = 0; $i < 5; $i++)<span style="--i: {{ $i }}">★</span>@endfor</div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="t-controls">
            <button type="button" class="cs-arrow" aria-label="Previous testimonial" data-deck-prev><x-icon name="chevron-left" :size="18" /></button>
            <div class="t-progress">
                <span class="t-count"><b data-counter>01</b> / {{ str_pad($count, 2, '0', STR_PAD_LEFT) }}</span>
                <span class="t-bar"><span data-deck-bar></span></span>
            </div>
            <button type="button" class="cs-arrow" aria-label="Next testimonial" data-deck-next><x-icon name="chevron-right" :size="18" /></button>
        </div>
    </div>
</section>
