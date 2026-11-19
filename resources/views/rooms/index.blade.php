@extends('layouts.app')

@section('title', 'Rooms — Nova Hospitality')

@section('content')
    <section class="rooms-page" aria-labelledby="rooms-page-title">
        <div class="rooms-page__hero">
            <div class="rooms-page__intro">
                <p class="eyebrow"><span></span> Rooms and stays</p>
                <h1 id="rooms-page-title">{{ $rooms['title_first'] }} <em>{{ $rooms['title_second'] }}</em></h1>
                <p>{{ $rooms['intro'] }}</p>
                <x-button href="{{ route('home') }}#contact">Ask about availability <span aria-hidden="true">↗</span></x-button>
            </div>
            <figure class="rooms-page__photo">
                <img src="{{ asset($rooms['image']) }}" alt="{{ $rooms['image_alt'] }}" width="1200" height="800">
                <figcaption>
                    <span>Illustrative reference · not a Nova room</span>
                    @if (filled($rooms['credit'] ?? null))
                        @if (filled($rooms['credit_url'] ?? null))
                            <a href="{{ $rooms['credit_url'] }}" target="_blank" rel="noopener noreferrer">{{ $rooms['credit'] }}</a>
                        @else
                            <span>{{ $rooms['credit'] }}</span>
                        @endif
                    @endif
                </figcaption>
            </figure>
        </div>

        <p class="rooms-page__notice" role="note">{{ $rooms['draft_notice'] }}</p>

        <div class="rooms-grid">
            @foreach ($rooms['types'] as $room)
                <article class="room-option">
                    <p class="room-option__label">Room category</p>
                    <h2>{{ $room['name'] }}</h2>
                    <div class="room-option__detail room-option__detail--services">
                        <span>Room details</span>
                        <p>{{ $room['description'] }}</p>
                    </div>
                    <div class="room-option__detail">
                        <span>Rate</span>
                        <strong>{{ $room['price'] }}</strong>
                    </div>
                    <div class="room-option__detail room-option__detail--services">
                        <span>Services and amenities</span>
                        <p>{{ $room['services'] }}</p>
                    </div>
                    <div class="room-option__detail">
                        <span>Availability</span>
                        <strong>{{ $room['availability'] }}</strong>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
