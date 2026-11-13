@php $s = config('etech.subscribe'); @endphp
<section id="contact" class="subscribe-panel" aria-labelledby="subscribe-title">
    <div class="container-x">
        <div class="subscribe-card">
            <h2 id="subscribe-title">{{ $s['title'] }}</h2>
            <p>{{ $s['text'] }}</p>
            <form data-static-form>
                <label class="sr-only" for="subscribe-email">Email</label>
                <input id="subscribe-email" type="email" name="email" placeholder="{{ $s['placeholder'] }}" required>
                <button type="submit" class="btn btn-white">{{ $s['button'] }}</button>
            </form>
        </div>
    </div>
</section>
