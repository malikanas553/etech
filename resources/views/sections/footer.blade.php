@php $f = config('etech.footer'); @endphp
<footer class="footer">
    <div class="container-x">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="#top" class="logo" aria-label="Back to top">{{ config('etech.brand') }}</a>
                <p class="footer-about">{{ $f['about'] }}</p>
                <div class="socials">
                    <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Etech on Facebook"><x-icon name="facebook" :size="13" /></a>
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Etech on Instagram"><x-icon name="instagram" :size="13" /></a>
                    <a href="https://x.com" target="_blank" rel="noopener noreferrer" aria-label="Etech on X (Twitter)"><x-icon name="twitter" :size="13" /></a>
                </div>
            </div>

            @foreach ($f['columns'] as $heading => $links)
                <div>
                    <h3>{{ $heading }}</h3>
                    <ul>
                        @foreach ($links as $link => $href)
                            <li><a href="{{ $href }}">{{ $link }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <div>
                <h3>Contact Us</h3>
                <ul>
                    <li><a href="tel:+15551234567">{{ $f['phone'] }}</a></li>
                    <li><a href="mailto:{{ $f['email'] }}">{{ $f['email'] }}</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">{{ $f['copyright'] }}</div>
    </div>
</footer>
