{{-- Mobile menu. Lives outside the sticky header so `position: fixed` covers the whole screen. --}}
<div class="drawer" id="mobile-menu" data-drawer role="dialog" aria-modal="true" aria-label="Menu" hidden>
    <div class="drawer-panel">
        <div class="flex items-center justify-between">
            <span class="logo">{{ config('etech.brand') }}</span>
            <button type="button" aria-label="Close menu" data-drawer-close><x-icon name="close" :size="22" /></button>
        </div>
        @foreach (config('etech.nav') as $item)
            <a href="#{{ $item['target'] }}" class="text-base font-medium py-1" data-drawer-link>{{ $item['label'] }}</a>
        @endforeach
        <a href="#contact" class="btn btn-outline h-11" data-drawer-link>Sign In</a>
        <a href="#courses" class="btn btn-primary h-11" data-drawer-link>Free Trial</a>
    </div>
</div>
