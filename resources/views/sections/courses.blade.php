@php $c = config('etech.courses'); @endphp
<section id="courses" class="courses" aria-labelledby="courses-title">
    <div class="container-x">
        <h2 id="courses-title" class="section-title">{{ $c['title'] }}</h2>
        <p class="section-sub">{{ $c['text'] }}</p>

        <div class="course-grid">
            @foreach ($c['items'] as $course)
                <article class="course-card">
                    <div class="thumb"><img src="{{ asset("images/{$course['image']}.webp") }}" alt="{{ $course['title'] }}" width="700" height="460" loading="lazy" decoding="async"></div>
                    <div class="course-body">
                        <div class="course-meta-top">
                            <span class="tag">{{ $course['tag'] }}</span>
                            <span class="rating"><x-icon name="star" :size="11" /> {{ $course['rating'] }}</span>
                        </div>
                        <h3>{{ $course['title'] }}</h3>
                        <div class="course-stats">
                            <span><x-icon name="book-open" :size="18" /> <span data-count="{{ $course['classes'] }}">{{ $course['classes'] }}</span> Classes</span>
                            <span><x-icon name="users" :size="18" /> <span data-count="{{ $course['students'] }}">{{ $course['students'] }}</span> Students</span>
                        </div>
                        <div class="course-foot">
                            <span class="price">{{ $course['price'] }}</span>
                            <span class="teacher"><span class="pic"><img src="{{ asset("images/{$course['avatar']}.webp") }}" alt=""></span>{{ $course['teacher'] }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
