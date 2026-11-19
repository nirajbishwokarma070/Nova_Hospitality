<header class="site-header" data-site-header>
    <div class="contact-bar">
        <div class="contact-bar__inner">
            <div class="contact-bar__left">
                <a class="contact-bar__item contact-bar__item--email" href="mailto:sagarshrestha813@gmail.com">
                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none">
                        <rect x="3" y="5" width="18" height="14" rx="1" />
                        <path d="m4 7 8 6 8-6" />
                    </svg>
                    <span>sagarshrestha813@gmail.com</span>
                </a>
                <div class="contact-bar__links">
                    <a class="contact-bar__item contact-bar__item--whatsapp" href="https://wa.me/9779855016037" target="_blank" rel="noopener noreferrer" aria-label="Message Nova Hospitality on WhatsApp at 9855016037">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none">
                            <path d="M20.2 11.8a8.2 8.2 0 0 1-12.1 7.3L3 20l.9-4.9a8.2 8.2 0 1 1 16.3-3.3Z" />
                            <path d="M8.2 7.7c.2-.5.4-.5.7-.5h.5c.2 0 .4.1.5.4l.7 1.7c.1.2.1.4 0 .6l-.5.7c-.2.2-.2.4 0 .6.6 1 1.4 1.7 2.4 2.2.2.1.4.1.6-.1l.8-.9c.2-.2.4-.2.7-.1l1.6.8c.3.1.4.3.4.5 0 .3-.2 1.1-.8 1.5-.5.4-1.1.6-1.9.4-1.2-.3-2.7-.9-4.2-2.3-1.1-1-2-2.3-2.2-3.3-.2-1 .2-1.8.7-2.2Z" />
                        </svg>
                        <span><span class="contact-bar__channel">WhatsApp</span> 9855016037</span>
                    </a>
                    <a class="contact-bar__item contact-bar__item--phone" href="tel:9855016037">
                        <svg aria-hidden="true" viewBox="0 0 24 24" fill="none">
                            <path d="M7.2 3.5h2.5l1.2 4.1-1.8 1.7a15 15 0 0 0 5.6 5.6l1.7-1.8 4.1 1.2v2.5a2 2 0 0 1-2.1 2A16.9 16.9 0 0 1 5.2 5.6a2 2 0 0 1 2-2.1Z" />
                        </svg>
                        <span>9855016037</span>
                    </a>
                </div>
            </div>
            <nav class="contact-bar__social" aria-label="Social media">
                <a class="contact-bar__social-link" href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M13.6 21v-8h2.7l.4-3h-3.1V8c0-.9.3-1.5 1.6-1.5h1.7V3.8c-.8-.1-1.7-.2-2.6-.2-2.6 0-4.4 1.6-4.4 4.5V10H7v3h2.9v8h3.7Z" />
                    </svg>
                </a>
                <a class="contact-bar__social-link" href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <svg aria-hidden="true" viewBox="0 0 24 24" fill="none">
                        <rect x="3.5" y="3.5" width="17" height="17" rx="5" />
                        <circle cx="12" cy="12" r="4" />
                        <circle cx="17.5" cy="6.8" r="1" class="contact-bar__social-dot" />
                    </svg>
                </a>
                <a class="contact-bar__social-link" href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" aria-label="YouTube">
                    <svg aria-hidden="true" viewBox="0 0 24 24">
                        <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2C0 8.1 0 12 0 12s0 3.9.5 5.8a3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1C24 15.9 24 12 24 12s0-3.9-.5-5.8ZM9.6 15.6V8.4l6.3 3.6-6.3 3.6Z" />
                    </svg>
                </a>
            </nav>
        </div>
    </div>
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
            <a href="{{ route('home') }}#rooms">Rooms</a>
            <a href="{{ route('home') }}#experience">Experience</a>
            <a href="{{ route('home') }}#gallery">Gallery</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </nav>
        <a class="header-contact" href="tel:9855016037">Call us <span aria-hidden="true">↗</span></a>
    </div>
</header>
