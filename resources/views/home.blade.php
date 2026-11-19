@extends('layouts.app')

@section('content')
    <section class="hero" id="home" aria-labelledby="hero-title" style="--hero-image: url('{{ asset('images/hero.webp') }}')">
        <div class="hero__content">
            <p class="eyebrow eyebrow--light"><span></span> Stay, Relax, Belong</p>
            <h1 id="hero-title">A New Chapter<br><span>in Hospitality</span></h1>
            <p class="hero__intro">A new place to slow down, feel at home, and make every stay memorable.</p>
            <div class="hero__actions">
                <x-button href="#about">Explore More <span aria-hidden="true">↗</span></x-button>
                <x-button href="#contact" variant="outline">Contact Us</x-button>
            </div>
        </div>
        <a class="hero__scroll" href="#about"><span></span> About Nova</a>
        <p class="hero__location">Kawasoti <span>·</span> Nepal</p>
    </section>

    <section class="about section-pad" id="about" aria-labelledby="about-title">
        <div class="about__image reveal">
            <img src="{{ asset('images/about.webp') }}" alt="Illustrative photograph of a calm, thoughtfully arranged guest room" width="1200" height="800" loading="lazy">
            <span class="image-note">A place to settle in</span>
        </div>
        <div class="about__copy reveal">
            <p class="eyebrow"><span></span> About Nova</p>
            <h2 id="about-title">Hospitality That<br><em>Feels Like Home</em></h2>
            <p>Nova Hospitality is based in Kawasoti-7, Nawalparasi East.</p>
            <p>Our approach is straightforward: a comfortable room, a warm welcome, and time to settle in at your own pace.</p>
            <x-button href="#experience" variant="text">See what matters to us <span aria-hidden="true">↗</span></x-button>
        </div>
    </section>

    <section class="experience section-pad" id="experience" aria-labelledby="experience-title">
        <div class="section-heading reveal">
            <div>
                <p class="eyebrow"><span></span> Our approach</p>
                <h2 id="experience-title">Experience the<br><em>Difference</em></h2>
            </div>
            <p>For us, it starts with the basics: a restful room, a personal welcome, and a little breathing room.</p>
        </div>
        <div class="experience-grid">
            <article class="experience-card reveal">
                <div class="experience-card__image">
                    <img src="{{ asset('images/stay.webp') }}" alt="Illustrative hospitality photography of a peaceful hotel setting" width="1200" height="800" loading="lazy">
                </div>
                <div class="experience-card__copy">
                    <h3>Comfortable Stays</h3>
                    <p>Room to unpack, settle in, and sleep comfortably.</p>
                </div>
            </article>
            <article class="experience-card reveal">
                <div class="experience-card__image">
                    <img src="{{ asset('images/hospitality.webp') }}" alt="Illustrative photograph of a warm and welcoming interior" width="1200" height="800" loading="lazy">
                </div>
                <div class="experience-card__copy">
                    <h3>Exceptional Hospitality</h3>
                    <p>A friendly welcome and attentive help throughout your stay.</p>
                </div>
            </article>
            <article class="experience-card reveal">
                <div class="experience-card__image">
                    <img src="{{ asset('images/moments.webp') }}" alt="Illustrative photograph of a quiet, welcoming place to gather" width="1200" height="800" loading="lazy">
                </div>
                <div class="experience-card__copy">
                    <h3>Memorable Experiences</h3>
                    <p>Space to slow down, enjoy a meal, and make the day your own.</p>
                </div>
            </article>
        </div>
        <p class="image-disclaimer">These three ideas guide the experience Nova hopes to offer.</p>
    </section>

    <section class="gallery section-pad" id="gallery" aria-labelledby="gallery-title">
        <div class="gallery__heading section-heading reveal">
            <div>
                <p class="eyebrow"><span></span> Spaces and surroundings</p>
                <h2 id="gallery-title">Explore Our<br><em>World</em></h2>
            </div>
            <p>A visual reference for the kinds of spaces and settings we appreciate.</p>
        </div>
        <div class="gallery-grid">
            <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset('images/architecture.webp') }}" data-gallery-alt="Illustrative photograph of contemporary architecture and its surroundings">
                <img src="{{ asset('images/architecture.webp') }}" alt="Illustrative photograph of contemporary architecture and its surroundings" width="1200" height="800" loading="lazy">
                <span>Architecture <span aria-hidden="true">↗</span></span>
            </button>
            <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset('images/gallery-table.webp') }}" data-gallery-alt="Illustrative photograph of a warmly prepared guest room">
                <img src="{{ asset('images/gallery-table.webp') }}" alt="Illustrative photograph of a warmly prepared guest room" width="1100" height="800" loading="lazy">
                <span>A restful room <span aria-hidden="true">↗</span></span>
            </button>
            <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset('images/gallery-room.webp') }}" data-gallery-alt="Illustrative photograph of a quiet hospitality interior">
                <img src="{{ asset('images/gallery-room.webp') }}" alt="Illustrative photograph of a quiet hospitality interior" width="1100" height="800" loading="lazy">
                <span>A quiet interior <span aria-hidden="true">↗</span></span>
            </button>
            <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset('images/dining.webp') }}" data-gallery-alt="Illustrative photograph of a thoughtful dining experience">
                <img src="{{ asset('images/dining.webp') }}" alt="Illustrative photograph of a thoughtful dining experience" width="1200" height="800" loading="lazy">
                <span>Dining <span aria-hidden="true">↗</span></span>
            </button>
            <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset('images/moments.webp') }}" data-gallery-alt="Illustrative photograph of a welcoming place to unwind">
                <img src="{{ asset('images/moments.webp') }}" alt="Illustrative photograph of a welcoming place to unwind" width="1200" height="800" loading="lazy">
                <span>A place to unwind <span aria-hidden="true">↗</span></span>
            </button>
            <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset('images/surroundings.webp') }}" data-gallery-alt="Illustrative photograph of a peaceful mountain landscape">
                <img src="{{ asset('images/surroundings.webp') }}" alt="Illustrative photograph of a peaceful mountain landscape" width="1200" height="800" loading="lazy">
                <span>Mountain surroundings <span aria-hidden="true">↗</span></span>
            </button>
        </div>
        <p class="image-disclaimer">Illustrative hospitality photography, not photographs of Nova Hospitality properties.</p>
    </section>

    <section class="contact section-pad" id="contact" aria-labelledby="contact-title">
        <div class="contact__intro reveal">
            <p class="eyebrow eyebrow--light"><span></span> Contact Nova Hospitality</p>
            <h2 id="contact-title">Get in <em>Touch</em></h2>
            <p>For enquiries, call or email us, or leave a message below.</p>
            <div class="contact-details">
                <div>
                    <span class="contact-details__label">Visit us</span>
                    <p>Kawasoti-7, Nawalparasi East,<br>Nepal</p>
                </div>
                <div>
                    <span class="contact-details__label">Call or write</span>
                    <a href="tel:9855016037">9855016037</a>
                    <a href="mailto:sagarshrestha813@gmail.com">sagarshrestha813@gmail.com</a>
                </div>
            </div>
        </div>
        <div class="contact__form-wrap reveal">
            <form class="contact-form" method="POST" action="{{ route('contact.store') }}#contact">
                @csrf
                @if (session('success'))
                    <p class="form-feedback form-feedback--success" role="status">{{ session('success') }}</p>
                @endif
                @if ($errors->any())
                    <div class="form-feedback form-feedback--error" role="alert">
                        Please check the highlighted fields and try again.
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-field">
                        <label for="name">Your name</label>
                        <input id="name" name="name" type="text" autocomplete="name" maxlength="120" value="{{ old('name') }}" required @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                        @error('name')<span class="field-error" id="name-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-field">
                        <label for="email">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" maxlength="254" value="{{ old('email') }}" required @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                        @error('email')<span class="field-error" id="email-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-field">
                    <label for="subject">Subject</label>
                    <input id="subject" name="subject" type="text" maxlength="160" value="{{ old('subject') }}" required @error('subject') aria-invalid="true" aria-describedby="subject-error" @enderror>
                    @error('subject')<span class="field-error" id="subject-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-field">
                    <label for="message">Your message</label>
                    <textarea id="message" name="message" rows="4" maxlength="5000" required @error('message') aria-invalid="true" aria-describedby="message-error" @enderror>{{ old('message') }}</textarea>
                    @error('message')<span class="field-error" id="message-error">{{ $message }}</span>@enderror
                </div>
                <x-button type="submit">Send message <span aria-hidden="true">↗</span></x-button>
            </form>
        </div>
    </section>

    <dialog class="image-preview" aria-label="Gallery image preview" data-image-preview>
        <button class="image-preview__close" type="button" aria-label="Close image preview" data-image-close>Close <span aria-hidden="true">×</span></button>
        <img alt="" data-preview-img>
    </dialog>
@endsection
