@php $f = config('etech.footer'); @endphp
<footer class="footer">
    <div class="container-x">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="/" class="logo">{{ config('etech.brand') }}</a>
                <p class="footer-about">{{ $f['about'] }}</p>
                <div class="socials">
                    <a href="#" aria-label="Facebook"><x-icon name="facebook" :size="13" /></a>
                    <a href="#" aria-label="Instagram"><x-icon name="instagram" :size="13" /></a>
                    <a href="#" aria-label="Twitter"><x-icon name="twitter" :size="13" /></a>
                </div>
            </div>

            @foreach ($f['columns'] as $heading => $links)
                <div>
                    <h4>{{ $heading }}</h4>
                    <ul>
                        @foreach ($links as $link)
                            <li><a href="#">{{ $link }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <div>
                <h4>Contact Us</h4>
                <ul>
                    <li><a href="tel:+15551234567">{{ $f['phone'] }}</a></li>
                    <li><a href="mailto:{{ $f['email'] }}">{{ $f['email'] }}</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">{{ $f['copyright'] }}</div>
    </div>
</footer>
