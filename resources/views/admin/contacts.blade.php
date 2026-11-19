@extends('layouts.admin')

@section('title', 'Contact inbox — Nova Hospitality')
@section('admin-context', 'Contact')

@section('content')
    <div class="admin-page-heading">
        <div>
            <p class="admin-eyebrow">Guest enquiries · {{ $unreadMessages }} unread</p>
            <h1>Contact inbox</h1>
            <p class="admin-description">Messages sent through the website contact form.</p>
        </div>
    </div>

    @if (session('success'))
        <p class="admin-notice" role="status">{{ session('success') }}</p>
    @endif

    <section class="admin-card admin-inbox" aria-label="Contact messages">
        @forelse ($messages as $message)
            <article class="admin-inbox-message {{ $message->read_at ? '' : 'is-unread' }}">
                <div class="admin-inbox-message__top">
                    <div>
                        <p class="admin-inbox-message__sender">{{ $message->name }} <a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                        <h2>{{ $message->subject }}</h2>
                    </div>
                    <time datetime="{{ $message->created_at->toIso8601String() }}">{{ $message->created_at->format('M j, Y · g:i a') }}</time>
                </div>
                <p class="admin-inbox-message__body">{{ $message->message }}</p>
                @unless ($message->read_at)
                    <form method="POST" action="{{ route('admin.contacts.read', $message) }}">
                        @csrf
                        <button class="admin-button admin-button--small" type="submit">Mark as read</button>
                    </form>
                @endunless
            </article>
        @empty
            <div class="admin-empty-state">
                <span aria-hidden="true">✉</span>
                <h2>Your inbox is clear</h2>
                <p>Website contact-form enquiries will show up here.</p>
            </div>
        @endforelse
        @if ($messages->hasPages())
            <div class="admin-pagination">{{ $messages->links() }}</div>
        @endif
    </section>
@endsection
