@php $nav = config('etech.nav'); @endphp
<nav class="container-x nav justify-between" aria-label="Main">
    <a href="#top" class="logo" aria-label="Etech home">{{ config('etech.brand') }}</a>

    <ul class="nav-links">
        @foreach ($nav as $item)
            <li @class(['nav-drop' => $item['dropdown']])>
                @if ($item['dropdown'])
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-dropdown>
                        {{ $item['label'] }} <x-icon name="chevron-down" :size="18" />
                    </button>
                    <div class="nav-drop-menu" role="menu">
                        @foreach ($item['dropdown'] as $link)
                            <a href="#{{ $item['target'] }}" role="menuitem">{{ $link }}</a>
                        @endforeach
                    </div>
                @else
                    <a href="#{{ $item['target'] }}">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ul>

    <div class="nav-actions flex gap-5">
        <a href="#contact" class="btn btn-outline">Sign In</a>
        <a href="#courses" class="btn btn-primary">Free Trial</a>
    </div>

    <button type="button" class="burger" aria-label="Open menu" aria-controls="mobile-menu" aria-expanded="false" data-drawer-open>
        <x-icon name="menu" :size="24" />
    </button>
</nav>
