<header class="site-header" data-site-header>
    <div class="site-header__inner">
        <a class="brand" href="{{ route('home') }}#home" aria-label="Nova Hospitality home">
            <img src="{{ asset('images/nova-hospitality-logo.jpg') }}" alt="Nova Hospitality — Stay, Relax, Belong" width="512" height="240">
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation" aria-label="Open navigation" data-menu-toggle>
            <span></span>
            <span></span>
        </button>
        <nav class="site-nav" id="primary-navigation" aria-label="Main navigation" data-site-nav>
            <a href="{{ route('home') }}#home">Home</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('home') }}#experience">Experience</a>
            <a href="{{ route('home') }}#gallery">Gallery</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </nav>
        <a class="header-contact" href="tel:9855016037">Call us <span aria-hidden="true">↗</span></a>
    </div>
</header>
