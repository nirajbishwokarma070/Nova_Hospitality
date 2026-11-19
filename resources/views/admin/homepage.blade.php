@extends('layouts.admin')

@section('title', 'Rooms and Gallery — Nova Hospitality')
@section('admin-context', 'Rooms & Gallery')

@section('content')
    <div class="admin-page-heading">
        <div>
            <p class="admin-eyebrow">Website content</p>
            <h1>Rooms &amp; Gallery</h1>
            <p class="admin-description">Manage only Section 03 (Rooms) and Section 05 (Gallery). Expand a row to edit its details.</p>
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

        <div class="admin-save-row">
            <button class="admin-button" type="submit">Save Rooms and Gallery</button>
        </div>
    </form>
@endsection
