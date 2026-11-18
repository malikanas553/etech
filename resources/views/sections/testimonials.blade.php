@php $t = config('etech.testimonials'); @endphp
<section id="testimonials" class="testimonials" aria-labelledby="testimonials-title" data-slider data-total="{{ $t['total'] }}">
    <div class="container-x">
        <h2 id="testimonials-title" class="section-title">{{ $t['title'] }}</h2>
        <p class="section-sub">{{ $t['text'] }}</p>

        <div class="t-viewport">
            <div class="t-track" data-track>
                @foreach ($t['items'] as $n => $item)
                    <article @class(['t-card', 'extra' => $n > 2])>
                        <div class="t-head">
                            <img src="{{ asset("images/{$item['avatar']}.webp") }}" alt="{{ $item['name'] }}" loading="lazy">
                            <div>
                                <div class="t-name">{{ $item['name'] }}</div>
                                <div class="t-role">{{ $item['role'] }}</div>
                                <div class="stars" role="img" aria-label="5 out of 5 stars">@for ($i = 0; $i < 5; $i++)<span style="--i: {{ $i }}">★</span>@endfor</div>
                            </div>
                        </div>
                        <p>{{ $item['quote'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>

        <div class="t-controls">
            <button type="button" aria-label="Previous testimonials" data-prev><x-icon name="chevron-left" :size="18" /></button>
            <span data-counter>01/{{ $t['total'] }}</span>
            <button type="button" aria-label="Next testimonials" data-next><x-icon name="chevron-right" :size="18" /></button>
        </div>
    </div>
</section>
