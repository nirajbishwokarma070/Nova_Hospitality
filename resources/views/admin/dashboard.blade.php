@extends('layouts.admin')

@section('title', 'Dashboard — Nova Hospitality')
@section('admin-context', 'Dashboard')

@section('content')
    <div class="admin-page-heading">
        <div>
            <p class="admin-eyebrow">Nova Hospitality</p>
            <h1>Dashboard</h1>
            <p class="admin-description">A quick overview of your website content and guest enquiries.</p>
        </div>
        <a class="admin-button admin-button--link" href="{{ route('admin.content.edit') }}">Edit homepage</a>
    </div>

    @if (session('success'))
        <p class="admin-notice" role="status">{{ session('success') }}</p>
    @endif

    <section class="admin-stats" aria-label="Website overview">
        <a class="admin-stat" href="{{ route('admin.content.edit', ['section' => 'rooms']) }}#rooms-fields">
            <span class="admin-stat__label">Room categories</span>
            <strong>{{ $roomCount }}</strong>
            <span class="admin-stat__meta">Manage room details <span aria-hidden="true">↗</span></span>
        </a>
        <a class="admin-stat" href="{{ route('admin.content.edit', ['section' => 'gallery']) }}#gallery-fields">
            <span class="admin-stat__label">Gallery images</span>
            <strong>{{ $galleryCount }}</strong>
            <span class="admin-stat__meta">Manage gallery <span aria-hidden="true">↗</span></span>
        </a>
        <a class="admin-stat" href="{{ route('admin.contacts.index') }}">
            <span class="admin-stat__label">Guest messages</span>
            <strong>{{ $messageCount }}</strong>
            <span class="admin-stat__meta">{{ $unreadMessages }} unread <span aria-hidden="true">↗</span></span>
        </a>
    </section>

    <section class="admin-card admin-dashboard-messages" aria-labelledby="latest-messages-title">
        <div class="admin-card-heading">
            <div>
                <p class="admin-eyebrow">Inbox</p>
                <h2 id="latest-messages-title">Recent messages</h2>
            </div>
            <a class="admin-text-link" href="{{ route('admin.contacts.index') }}">Open inbox <span aria-hidden="true">→</span></a>
        </div>
        @forelse ($latestMessages as $message)
            <a class="admin-message-row" href="{{ route('admin.contacts.index') }}">
                <span class="admin-message-row__status {{ $message->read_at ? '' : 'is-unread' }}" aria-hidden="true"></span>
                <span class="admin-message-row__body">
                    <strong>{{ $message->subject }}</strong>
                    <small>{{ $message->name }} · {{ $message->created_at->format('M j, Y · g:i a') }}</small>
                </span>
                <span class="admin-message-row__arrow" aria-hidden="true">↗</span>
            </a>
        @empty
            <p class="admin-empty">No messages yet. New website enquiries will appear here.</p>
        @endforelse
    </section>
@endsection
