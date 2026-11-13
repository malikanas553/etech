@php $b = config('etech.benefits'); @endphp
<section class="benefits container-x" aria-labelledby="benefits-title">
    <div class="benefits-grid">
        <div class="collage">
            <div class="collage-grid">
                <div class="tile-pink tl"><img src="{{ asset('images/student-1.webp') }}" alt="Student holding books"></div>
                <div class="tile-purple"><img src="{{ asset('images/student-2.webp') }}" alt="Student with backpack"></div>
                <div class="tile-purple"><img src="{{ asset('images/student-3.webp') }}" alt="Student reading"></div>
                <div class="tile-pink"><img src="{{ asset('images/student-4.webp') }}" alt="Student with a tablet"></div>
            </div>
        </div>

        <div>
            <h2 id="benefits-title"><span class="accent">{{ $b['accent'] }}</span> {{ $b['title'] }}</h2>
            <div class="benefit-list">
                @foreach ($b['items'] as $item)
                    <div class="benefit">
                        <span class="benefit-ico {{ $item['color'] }}"><x-icon :name="$item['icon']" :size="26" /></span>
                        <div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
