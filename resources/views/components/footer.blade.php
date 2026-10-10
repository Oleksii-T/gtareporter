<footer class="site-footer">
    <div class="footer-main">
        <div>
            <a class="brand brand--footer" href="{{ route('index') }}"><span class="brand-mark" aria-hidden="true">VI</span><span class="brand-type"><strong>{{ $footer?->show('site-name') ?: 'GTA VI NEWS' }}</strong><span>FROM LEONIDA, WITH LOVE.</span></span></a>
            <p class="footer-description">The news. The details. The road to Vice City.<br>An independent publication for the GTA community.</p>
        </div>
        <nav class="footer-links" aria-label="Footer navigation">
            <a href="{{ route('about-us') }}">About us</a>
            <a href="{{ route('contact-us') }}">Get in touch</a>
            <a href="{{ route('reviewPolicy') }}">Editorial policy</a>
            <a href="{{ route('privacy') }}">Privacy policy</a>
            <a href="{{ route('terms') }}">Terms of service</a>
            <a href="{{ route('cookiePolicy') }}">Cookie policy</a>
        </nav>
        <a class="back-to-top" href="#page-top">Back to top <span aria-hidden="true">↑</span></a>
    </div>
    <div class="footer-bottom"><p>&copy; {{ date('Y') }} {{ $footer?->show('site-name') ?: 'GTA VI News' }}. Independent. Always.</p><p>Not affiliated with Rockstar Games. Game imagery &copy; Rockstar Games.</p></div>
</footer>
