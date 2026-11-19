<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-brand">
            <a class="brand" href="{{ route('home') }}#home" aria-label="Nova Hospitality home">
                <img src="{{ asset('images/nova-hospitality-logo.jpg') }}" alt="Nova Hospitality — Stay, Relax, Belong" width="512" height="240" loading="lazy">
            </a>
            <p>Hospitality in Kawasoti-7, Nawalparasi East, Nepal.</p>
        </div>
        <div class="footer-links">
            <h2>Explore</h2>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('home') }}#rooms">Rooms</a>
            <a href="{{ route('home') }}#experience">Experience</a>
            <a href="{{ route('home') }}#gallery">Gallery</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
        <div class="footer-contact">
            <h2>Get in touch</h2>
            <a href="tel:9855016037">9855016037</a>
            <a href="mailto:sagarshrestha813@gmail.com">sagarshrestha813@gmail.com</a>
            <p>Kawasoti-7, Nawalparasi East, Nepal</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© {{ date('Y') }} Nova Hospitality. All rights reserved.</p>
        <a href="{{ route('home') }}#home">Stay, Relax, Belong <span aria-hidden="true">↑</span></a>
    </div>
</footer>
