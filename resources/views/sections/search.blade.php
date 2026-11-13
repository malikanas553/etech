@php $s = config('etech.search'); @endphp
<section class="search container-x" aria-labelledby="search-title">
    <h2 id="search-title" class="section-title">{{ $s['title'] }}</h2>
    <form role="search" data-static-form>
        <label class="search-field">
            <span class="sr-only">{{ $s['placeholder'] }}</span>
            <x-icon name="search" :size="20" />
            <input type="search" name="q" placeholder="{{ $s['placeholder'] }}">
        </label>
        <button type="submit" class="btn btn-primary">{{ $s['button'] }}</button>
    </form>
</section>
