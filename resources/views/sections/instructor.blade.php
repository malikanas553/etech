@php $i = config('etech.instructor'); @endphp
<section class="instructor container-x" aria-labelledby="instructor-title">
    <div class="instructor-grid">
        <div>
            <h2 id="instructor-title">{{ $i['title'] }} <span class="accent">{{ $i['accent'] }}</span></h2>
            <p class="lead">{{ $i['text'] }}</p>
            <h3>{{ $i['perks_title'] }}</h3>
            <ul class="perks">
                @foreach ($i['perks'] as $perk)
                    <li>{{ $perk }}</li>
                @endforeach
            </ul>
            <a href="#" class="btn btn-primary">{{ $i['cta'] }}</a>
        </div>

        <div class="arch">
            <div class="arch-inner">
                <img src="{{ asset('images/instructor.webp') }}" alt="Certified teacher with a notepad" loading="lazy">
            </div>
        </div>
    </div>
</section>
