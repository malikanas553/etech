@php $s = config('etech.search'); @endphp
<section class="search container-x" aria-labelledby="search-title">
    <h2 id="search-title" class="section-title">{{ $s['title'] }}</h2>
    <form role="search" data-static-form>
        <label class="search-field">
            <span class="sr-only">{{ $s['placeholder'] }}</span>
            <x-icon name="search" :size="20" />
            <input type="search" name="q" placeholder="{{ $s['placeholder'] }}" data-placeholder-short="Search 50+ courses" autocomplete="off">
        </label>
        <button type="submit" class="btn btn-primary">{{ $s['button'] }}</button>
    </form>
    <p class="sr-only" data-status role="status" aria-live="polite"></p>
</section>
