@php $nav = config('etech.nav'); @endphp
<nav class="container-x nav justify-between" aria-label="Main">
    <a href="/" class="logo">{{ config('etech.brand') }}</a>

    <ul class="nav-links">
        @foreach ($nav as $item)
            <li @class(['nav-drop' => $item['dropdown']])>
                @if ($item['dropdown'])
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-dropdown>
                        {{ $item['label'] }} <x-icon name="chevron-down" :size="18" />
                    </button>
                    <div class="nav-drop-menu" role="menu">
                        @foreach ($item['dropdown'] as $link)
                            <a href="#" role="menuitem">{{ $link }}</a>
                        @endforeach
                    </div>
                @else
                    <a href="#contact">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ul>

    <div class="nav-actions flex gap-5">
        <a href="#" class="btn btn-outline">Sign In</a>
        <a href="#" class="btn btn-primary">Free Trial</a>
    </div>

    <button type="button" class="burger" aria-label="Open menu" data-drawer-open>
        <x-icon name="menu" :size="22" />
    </button>
</nav>

<div class="drawer" data-drawer>
    <div class="drawer-panel">
        <div class="flex items-center justify-between">
            <span class="logo">{{ config('etech.brand') }}</span>
            <button type="button" aria-label="Close menu" data-drawer-close><x-icon name="close" :size="22" /></button>
        </div>
        @foreach ($nav as $item)
            <a href="#" class="text-base font-medium">{{ $item['label'] }}</a>
        @endforeach
        <a href="#" class="btn btn-outline h-11">Sign In</a>
        <a href="#" class="btn btn-primary h-11">Free Trial</a>
    </div>
</div>
