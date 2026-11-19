@extends('layouts.admin')

@section('title', 'Homepage editor — Nova Hospitality')
@section('admin-context', 'Homepage editor')

@section('content')
    <div class="admin-page-heading">
        <div>
            <p class="admin-eyebrow">Website content</p>
            <h1>Homepage editor</h1>
            <p class="admin-description">Update the words and photos visitors see. Leave an image blank to keep it. Credit stock photos; clear the credit for photos you own.</p>
        </div>
    </div>

    @if (session('success'))
        <p class="admin-notice" role="status">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div class="admin-notice admin-notice--error" role="alert">Please review the highlighted fields and try again.</div>
    @endif

    <form class="admin-editor" method="POST" action="{{ route('admin.content.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="section" value="{{ request()->query('section', '') }}">

        <section class="admin-card admin-section" aria-labelledby="hero-fields">
            <div class="admin-section__heading">
                <p class="admin-eyebrow">Section 01</p>
                <h2 id="hero-fields">Hero</h2>
            </div>
            <div class="admin-fields">
                <div class="admin-field">
                    <label for="hero-title-first">Heading, first line</label>
                    <input id="hero-title-first" name="hero[title_first]" value="{{ old('hero.title_first', $content['hero']['title_first']) }}" maxlength="80" required>
                    @error('hero.title_first')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field">
                    <label for="hero-title-second">Heading, second line</label>
                    <input id="hero-title-second" name="hero[title_second]" value="{{ old('hero.title_second', $content['hero']['title_second']) }}" maxlength="80" required>
                    @error('hero.title_second')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="hero-intro">Supporting text</label>
                    <textarea id="hero-intro" name="hero[intro]" rows="2" maxlength="300" required>{{ old('hero.intro', $content['hero']['intro']) }}</textarea>
                    @error('hero.intro')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-image-field">
                    <img src="{{ asset($content['hero']['image']) }}" alt="" loading="lazy">
                    <div class="admin-field">
                        <label for="hero-image">Replace hero image</label>
                        <input id="hero-image" name="hero[image_upload]" type="file" accept="image/jpeg,image/png,image/webp">
                        <small>JPG, PNG, or WebP; maximum 5 MB.</small>
                        @error('hero.image_upload')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="hero-credit">Photo credit (optional)</label>
                        <input id="hero-credit" name="hero[credit]" value="{{ old('hero.credit', $content['hero']['credit'] ?? '') }}" maxlength="120">
                        @error('hero.credit')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="hero-credit-url">Credit link (optional)</label>
                        <input id="hero-credit-url" name="hero[credit_url]" type="url" value="{{ old('hero.credit_url', $content['hero']['credit_url'] ?? '') }}" maxlength="2048">
                        @error('hero.credit_url')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </section>

        <section class="admin-card admin-section" aria-labelledby="about-fields">
            <div class="admin-section__heading">
                <p class="admin-eyebrow">Section 02</p>
                <h2 id="about-fields">About</h2>
            </div>
            <div class="admin-fields">
                <div class="admin-field">
                    <label for="about-title-first">Heading, first line</label>
                    <input id="about-title-first" name="about[title_first]" value="{{ old('about.title_first', $content['about']['title_first']) }}" maxlength="80" required>
                    @error('about.title_first')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field">
                    <label for="about-title-second">Heading, second line</label>
                    <input id="about-title-second" name="about[title_second]" value="{{ old('about.title_second', $content['about']['title_second']) }}" maxlength="80" required>
                    @error('about.title_second')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="about-intro">Introduction</label>
                    <textarea id="about-intro" name="about[intro]" rows="2" maxlength="300" required>{{ old('about.intro', $content['about']['intro']) }}</textarea>
                    @error('about.intro')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="about-description">Description</label>
                    <textarea id="about-description" name="about[description]" rows="3" maxlength="600" required>{{ old('about.description', $content['about']['description']) }}</textarea>
                    @error('about.description')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-image-field">
                    <img src="{{ asset($content['about']['image']) }}" alt="" loading="lazy">
                    <div class="admin-field">
                        <label for="about-image">Replace about image</label>
                        <input id="about-image" name="about[image_upload]" type="file" accept="image/jpeg,image/png,image/webp">
                        <small>JPG, PNG, or WebP; maximum 5 MB.</small>
                        @error('about.image_upload')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="about-image-alt">Image description</label>
                        <input id="about-image-alt" name="about[image_alt]" value="{{ old('about.image_alt', $content['about']['image_alt']) }}" maxlength="180" required>
                        @error('about.image_alt')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="about-credit">Photo credit (optional)</label>
                        <input id="about-credit" name="about[credit]" value="{{ old('about.credit', $content['about']['credit'] ?? '') }}" maxlength="120">
                        @error('about.credit')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="about-credit-url">Credit link (optional)</label>
                        <input id="about-credit-url" name="about[credit_url]" type="url" value="{{ old('about.credit_url', $content['about']['credit_url'] ?? '') }}" maxlength="2048">
                        @error('about.credit_url')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </section>

        <section class="admin-card admin-section" aria-labelledby="rooms-fields">
            <div class="admin-section__heading">
                <p class="admin-eyebrow">Section 03</p>
                <h2 id="rooms-fields">Rooms</h2>
            </div>
            <details class="admin-compact-details admin-compact-details--page" @if ($errors->any()) open @endif>
                <summary>Page heading, notice and feature photo <span>Expand to edit</span></summary>
                <div class="admin-fields admin-compact-details__content">
                <div class="admin-field">
                    <label for="rooms-title-first">Heading, first line</label>
                    <input id="rooms-title-first" name="rooms[title_first]" value="{{ old('rooms.title_first', $content['rooms']['title_first']) }}" maxlength="80" required>
                    @error('rooms.title_first')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field">
                    <label for="rooms-title-second">Heading, second line</label>
                    <input id="rooms-title-second" name="rooms[title_second]" value="{{ old('rooms.title_second', $content['rooms']['title_second']) }}" maxlength="80" required>
                    @error('rooms.title_second')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="rooms-intro">Room information</label>
                    <textarea id="rooms-intro" name="rooms[intro]" rows="2" maxlength="300" required>{{ old('rooms.intro', $content['rooms']['intro']) }}</textarea>
                    @error('rooms.intro')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="rooms-draft-notice">Room information notice</label>
                    <textarea id="rooms-draft-notice" name="rooms[draft_notice]" rows="2" maxlength="400" required>{{ old('rooms.draft_notice', $content['rooms']['draft_notice']) }}</textarea>
                    @error('rooms.draft_notice')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-image-field">
                    <img src="{{ asset($content['rooms']['image']) }}" alt="" loading="lazy">
                    <div class="admin-field">
                        <label for="rooms-image">Replace rooms image</label>
                        <input id="rooms-image" name="rooms[image_upload]" type="file" accept="image/jpeg,image/png,image/webp">
                        <small>JPG, PNG, or WebP; maximum 5 MB.</small>
                        @error('rooms.image_upload')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="rooms-image-alt">Image description</label>
                        <input id="rooms-image-alt" name="rooms[image_alt]" value="{{ old('rooms.image_alt', $content['rooms']['image_alt']) }}" maxlength="180" required>
                        @error('rooms.image_alt')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="rooms-credit">Photo credit (optional)</label>
                        <input id="rooms-credit" name="rooms[credit]" value="{{ old('rooms.credit', $content['rooms']['credit'] ?? '') }}" maxlength="120">
                        @error('rooms.credit')<span class="admin-error">{{ $message }}</span>@enderror
                        <label for="rooms-credit-url">Credit link (optional)</label>
                        <input id="rooms-credit-url" name="rooms[credit_url]" type="url" value="{{ old('rooms.credit_url', $content['rooms']['credit_url'] ?? '') }}" maxlength="2048">
                        @error('rooms.credit_url')<span class="admin-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                </div>
            </details>
            @foreach ($content['rooms']['types'] as $index => $room)
                <details class="admin-subsection admin-compact-details admin-compact-details--item" @if ($errors->any()) open @endif>
                    <summary class="admin-compact-details__summary">
                        <span class="admin-compact-details__caption">Room {{ $index + 1 }} · {{ $room['name'] }}</span>
                        <small>{{ $room['price'] }}</small>
                    </summary>
                    <div class="admin-fields">
                        <div class="admin-field">
                            <label for="room-{{ $index }}-name">Room type</label>
                            <input id="room-{{ $index }}-name" name="rooms[types][{{ $index }}][name]" value="{{ old("rooms.types.$index.name", $room['name']) }}" maxlength="100" required>
                            @error("rooms.types.$index.name")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-field">
                            <label for="room-{{ $index }}-price">Price or rate note</label>
                            <input id="room-{{ $index }}-price" name="rooms[types][{{ $index }}][price]" value="{{ old("rooms.types.$index.price", $room['price']) }}" maxlength="100" required>
                            @error("rooms.types.$index.price")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-field admin-field--wide">
                            <label for="room-{{ $index }}-description">Description</label>
                            <textarea id="room-{{ $index }}-description" name="rooms[types][{{ $index }}][description]" rows="2" maxlength="400" required>{{ old("rooms.types.$index.description", $room['description']) }}</textarea>
                            @error("rooms.types.$index.description")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-field admin-field--wide">
                            <label for="room-{{ $index }}-services">Services and amenities</label>
                            <textarea id="room-{{ $index }}-services" name="rooms[types][{{ $index }}][services]" rows="2" maxlength="400" required>{{ old("rooms.types.$index.services", $room['services']) }}</textarea>
                            @error("rooms.types.$index.services")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-field admin-field--wide">
                            <label for="room-{{ $index }}-availability">Availability</label>
                            <input id="room-{{ $index }}-availability" name="rooms[types][{{ $index }}][availability]" value="{{ old("rooms.types.$index.availability", $room['availability']) }}" maxlength="120" required>
                            @error("rooms.types.$index.availability")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </details>
            @endforeach
        </section>

        <section class="admin-card admin-section" aria-labelledby="experience-fields">
            <div class="admin-section__heading">
                <p class="admin-eyebrow">Section 04</p>
                <h2 id="experience-fields">Experience</h2>
            </div>
            <div class="admin-fields">
                <div class="admin-field">
                    <label for="experience-title-first">Heading, first line</label>
                    <input id="experience-title-first" name="experience[title_first]" value="{{ old('experience.title_first', $content['experience']['title_first']) }}" maxlength="80" required>
                    @error('experience.title_first')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field">
                    <label for="experience-title-second">Heading, second line</label>
                    <input id="experience-title-second" name="experience[title_second]" value="{{ old('experience.title_second', $content['experience']['title_second']) }}" maxlength="80" required>
                    @error('experience.title_second')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="experience-intro">Supporting text</label>
                    <textarea id="experience-intro" name="experience[intro]" rows="2" maxlength="300" required>{{ old('experience.intro', $content['experience']['intro']) }}</textarea>
                    @error('experience.intro')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
            </div>
            @foreach ($content['experience']['services'] as $index => $service)
                <fieldset class="admin-subsection">
                    <legend>Service {{ $index + 1 }}</legend>
                    <div class="admin-fields">
                        <div class="admin-field">
                            <label for="service-{{ $index }}-title">Title</label>
                            <input id="service-{{ $index }}-title" name="experience[services][{{ $index }}][title]" value="{{ old("experience.services.$index.title", $service['title']) }}" maxlength="100" required>
                            @error("experience.services.$index.title")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-field admin-field--wide">
                            <label for="service-{{ $index }}-description">Description</label>
                            <textarea id="service-{{ $index }}-description" name="experience[services][{{ $index }}][description]" rows="2" maxlength="300" required>{{ old("experience.services.$index.description", $service['description']) }}</textarea>
                            @error("experience.services.$index.description")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-image-field">
                            <img src="{{ asset($service['image']) }}" alt="" loading="lazy">
                            <div class="admin-field">
                                <label for="service-{{ $index }}-image">Replace service image</label>
                                <input id="service-{{ $index }}-image" name="experience[services][{{ $index }}][image_upload]" type="file" accept="image/jpeg,image/png,image/webp">
                                <small>JPG, PNG, or WebP; maximum 5 MB.</small>
                                @error("experience.services.$index.image_upload")<span class="admin-error">{{ $message }}</span>@enderror
                                <label for="service-{{ $index }}-alt">Image description</label>
                                <input id="service-{{ $index }}-alt" name="experience[services][{{ $index }}][image_alt]" value="{{ old("experience.services.$index.image_alt", $service['image_alt']) }}" maxlength="180" required>
                                @error("experience.services.$index.image_alt")<span class="admin-error">{{ $message }}</span>@enderror
                                <label for="service-{{ $index }}-credit">Photo credit (optional)</label>
                                <input id="service-{{ $index }}-credit" name="experience[services][{{ $index }}][credit]" value="{{ old("experience.services.$index.credit", $service['credit'] ?? '') }}" maxlength="120">
                                @error("experience.services.$index.credit")<span class="admin-error">{{ $message }}</span>@enderror
                                <label for="service-{{ $index }}-credit-url">Credit link (optional)</label>
                                <input id="service-{{ $index }}-credit-url" name="experience[services][{{ $index }}][credit_url]" type="url" value="{{ old("experience.services.$index.credit_url", $service['credit_url'] ?? '') }}" maxlength="2048">
                                @error("experience.services.$index.credit_url")<span class="admin-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
            @endforeach
        </section>

        <section class="admin-card admin-section" aria-labelledby="gallery-fields">
            <div class="admin-section__heading">
                <p class="admin-eyebrow">Section 05</p>
                <h2 id="gallery-fields">Gallery</h2>
            </div>
            <details class="admin-compact-details admin-compact-details--page" @if ($errors->any()) open @endif>
                <summary>Gallery heading and supporting text <span>Expand to edit</span></summary>
                <div class="admin-fields admin-compact-details__content">
                <div class="admin-field">
                    <label for="gallery-title-first">Heading, first line</label>
                    <input id="gallery-title-first" name="gallery[title_first]" value="{{ old('gallery.title_first', $content['gallery']['title_first']) }}" maxlength="80" required>
                    @error('gallery.title_first')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field">
                    <label for="gallery-title-second">Heading, second line</label>
                    <input id="gallery-title-second" name="gallery[title_second]" value="{{ old('gallery.title_second', $content['gallery']['title_second']) }}" maxlength="80" required>
                    @error('gallery.title_second')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="gallery-intro">Supporting text</label>
                    <textarea id="gallery-intro" name="gallery[intro]" rows="2" maxlength="300" required>{{ old('gallery.intro', $content['gallery']['intro']) }}</textarea>
                    @error('gallery.intro')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                </div>
            </details>
            @foreach ($content['gallery']['images'] as $index => $image)
                <details class="admin-subsection admin-compact-details admin-compact-details--item admin-compact-details--gallery" @if ($errors->any()) open @endif>
                    <summary class="admin-compact-details__summary">
                        <img class="admin-compact-details__thumb" src="{{ asset($image['image']) }}" alt="" loading="lazy">
                        <span class="admin-compact-details__caption">Image {{ $index + 1 }}</span>
                        <strong>{{ $image['caption'] }}</strong>
                    </summary>
                    <div class="admin-fields">
                        <div class="admin-field">
                            <label for="gallery-{{ $index }}-caption">Caption</label>
                            <input id="gallery-{{ $index }}-caption" name="gallery[images][{{ $index }}][caption]" value="{{ old("gallery.images.$index.caption", $image['caption']) }}" maxlength="100" required>
                            @error("gallery.images.$index.caption")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-field">
                            <label for="gallery-{{ $index }}-alt">Image description</label>
                            <input id="gallery-{{ $index }}-alt" name="gallery[images][{{ $index }}][alt]" value="{{ old("gallery.images.$index.alt", $image['alt']) }}" maxlength="180" required>
                            @error("gallery.images.$index.alt")<span class="admin-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="admin-image-field">
                            <img src="{{ asset($image['image']) }}" alt="" loading="lazy">
                            <div class="admin-field">
                                <label for="gallery-{{ $index }}-image">Replace gallery image</label>
                                <input id="gallery-{{ $index }}-image" name="gallery[images][{{ $index }}][image_upload]" type="file" accept="image/jpeg,image/png,image/webp">
                                <small>JPG, PNG, or WebP; maximum 5 MB.</small>
                                @error("gallery.images.$index.image_upload")<span class="admin-error">{{ $message }}</span>@enderror
                                <label for="gallery-{{ $index }}-credit">Photo credit (optional)</label>
                                <input id="gallery-{{ $index }}-credit" name="gallery[images][{{ $index }}][credit]" value="{{ old("gallery.images.$index.credit", $image['credit'] ?? '') }}" maxlength="120">
                                @error("gallery.images.$index.credit")<span class="admin-error">{{ $message }}</span>@enderror
                                <label for="gallery-{{ $index }}-credit-url">Credit link (optional)</label>
                                <input id="gallery-{{ $index }}-credit-url" name="gallery[images][{{ $index }}][credit_url]" type="url" value="{{ old("gallery.images.$index.credit_url", $image['credit_url'] ?? '') }}" maxlength="2048">
                                @error("gallery.images.$index.credit_url")<span class="admin-error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </details>
            @endforeach
        </section>

        <section class="admin-card admin-section" aria-labelledby="contact-fields">
            <div class="admin-section__heading">
                <p class="admin-eyebrow">Section 06</p>
                <h2 id="contact-fields">Contact introduction</h2>
            </div>
            <div class="admin-fields">
                <div class="admin-field">
                    <label for="contact-title-first">Heading, first part</label>
                    <input id="contact-title-first" name="contact[title_first]" value="{{ old('contact.title_first', $content['contact']['title_first']) }}" maxlength="80" required>
                    @error('contact.title_first')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field">
                    <label for="contact-title-second">Heading, second part</label>
                    <input id="contact-title-second" name="contact[title_second]" value="{{ old('contact.title_second', $content['contact']['title_second']) }}" maxlength="80" required>
                    @error('contact.title_second')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
                <div class="admin-field admin-field--wide">
                    <label for="contact-intro">Supporting text</label>
                    <textarea id="contact-intro" name="contact[intro]" rows="2" maxlength="300" required>{{ old('contact.intro', $content['contact']['intro']) }}</textarea>
                    @error('contact.intro')<span class="admin-error">{{ $message }}</span>@enderror
                </div>
            </div>
            <p class="admin-help">The business phone number, email, and address are kept as verified contact details and are not changed here.</p>
        </section>

        <div class="admin-save-row">
            <button class="admin-button" type="submit">Save homepage changes</button>
        </div>
    </form>
@endsection
