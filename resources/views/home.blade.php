@extends('layouts.app')

@section('content')
    <section class="hero" id="home" aria-labelledby="hero-title" style="--hero-image: url('{{ asset($content['hero']['image']) }}')">
        <div class="hero__content">
            <p class="eyebrow eyebrow--light"><span></span> Stay, Relax, Belong</p>
            <h1 id="hero-title">{{ $content['hero']['title_first'] }}<br><span>{{ $content['hero']['title_second'] }}</span></h1>
            <p class="hero__intro">{{ $content['hero']['intro'] }}</p>
            <div class="hero__actions">
                <x-button href="#about">Explore More <span aria-hidden="true">↗</span></x-button>
                <x-button href="#contact" variant="outline">Contact Us</x-button>
            </div>
        </div>
        <a class="hero__scroll" href="#about"><span></span> About Nova</a>
        <p class="hero__location">Kawasoti <span>·</span> Nepal</p>
        <p class="hero__photo-note">Illustrative photography · not a Nova property</p>
    </section>

    <section class="about section-pad" id="about" aria-labelledby="about-title">
        <div class="about__image reveal">
            <img src="{{ asset($content['about']['image']) }}" alt="{{ $content['about']['image_alt'] }}" width="1200" height="800" loading="lazy">
            <span class="image-note">Illustrative photo · not a Nova property</span>
        </div>
        <div class="about__copy reveal">
            <p class="eyebrow"><span></span> About Nova</p>
            <h2 id="about-title">{{ $content['about']['title_first'] }}<br><em>{{ $content['about']['title_second'] }}</em></h2>
            <p>{{ $content['about']['intro'] }}</p>
            <p>{{ $content['about']['description'] }}</p>
            <x-button href="#experience" variant="text">See what matters to us <span aria-hidden="true">↗</span></x-button>
        </div>
    </section>

    <section class="rooms section-pad" id="rooms" aria-labelledby="rooms-title">
        <div class="rooms__copy reveal">
            <p class="eyebrow"><span></span> Rooms</p>
            <h2 id="rooms-title">{{ $content['rooms']['title_first'] }}<br><em>{{ $content['rooms']['title_second'] }}</em></h2>
            <p>{{ $content['rooms']['intro'] }}</p>
            <x-button href="{{ route('rooms.index') }}" variant="text">Explore room options <span aria-hidden="true">↗</span></x-button>
        </div>
        <div class="rooms__image reveal">
            <img src="{{ asset($content['rooms']['image']) }}" alt="{{ $content['rooms']['image_alt'] }}" width="1200" height="800" loading="lazy">
            <span class="image-note">Illustrative photo · not a Nova room</span>
        </div>
    </section>

    <section class="experience section-pad" id="experience" aria-labelledby="experience-title">
        <div class="section-heading reveal">
            <div>
                <p class="eyebrow"><span></span> Our approach</p>
                <h2 id="experience-title">{{ $content['experience']['title_first'] }}<br><em>{{ $content['experience']['title_second'] }}</em></h2>
            </div>
            <p>{{ $content['experience']['intro'] }}</p>
        </div>
        <div class="experience-grid">
            @foreach ($content['experience']['services'] as $service)
                <article class="experience-card reveal">
                    <div class="experience-card__image">
                        <img src="{{ asset($service['image']) }}" alt="{{ $service['image_alt'] }}" width="1200" height="800" loading="lazy">
                    </div>
                    <div class="experience-card__copy">
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
        <p class="image-disclaimer">These illustrative photographs do not depict Nova Hospitality properties.</p>
        @if ($credits->isNotEmpty())
            <details class="image-credits">
                <summary>Photo credits</summary>
                <ul>
                    @foreach ($credits as $credit)
                        <li>
                            @if (filled($credit['credit_url']))
                                <a href="{{ $credit['credit_url'] }}" target="_blank" rel="noopener noreferrer">{{ $credit['credit'] }}</a>
                            @else
                                {{ $credit['credit'] }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </details>
        @endif
    </section>

    <section class="gallery section-pad" id="gallery" aria-labelledby="gallery-title">
        <div class="gallery__heading section-heading reveal">
            <div>
                <p class="eyebrow"><span></span> Spaces and surroundings</p>
                <h2 id="gallery-title">{{ $content['gallery']['title_first'] }}<br><em>{{ $content['gallery']['title_second'] }}</em></h2>
            </div>
            <p>{{ $content['gallery']['intro'] }}</p>
        </div>
        <div class="gallery-grid">
            @foreach ($content['gallery']['images'] as $image)
                <button class="gallery-item reveal" type="button" data-gallery-image="{{ asset($image['image']) }}" data-gallery-alt="{{ $image['alt'] }}">
                    <img src="{{ asset($image['image']) }}" alt="{{ $image['alt'] }}" width="1200" height="800" loading="lazy">
                    <span>{{ $image['caption'] }} <span aria-hidden="true">↗</span></span>
                </button>
            @endforeach
        </div>
        <p class="image-disclaimer">These illustrative photographs do not depict Nova Hospitality properties.</p>
    </section>

    <section class="contact section-pad" id="contact" aria-labelledby="contact-title">
        <div class="contact__intro reveal">
            <p class="eyebrow eyebrow--light"><span></span> Contact Nova Hospitality</p>
            <h2 id="contact-title">{{ $content['contact']['title_first'] }} <em>{{ $content['contact']['title_second'] }}</em></h2>
            <p>{{ $content['contact']['intro'] }}</p>
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
