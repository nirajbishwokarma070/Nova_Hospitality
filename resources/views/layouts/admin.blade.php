<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#171a19">
    <title>@yield('title', 'Admin — Nova Hospitality')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/nova-hospitality-logo.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
    @auth
        <div class="admin-shell" data-admin-shell>
            <aside class="admin-sidebar" id="admin-sidebar" aria-label="Admin sidebar">
                <a class="admin-brand" href="{{ route('admin.dashboard') }}" aria-label="Nova Hospitality dashboard">
                    <img src="{{ asset('images/nova-hospitality-logo.jpg') }}" alt="Nova Hospitality" width="512" height="240">
                    <span>Admin</span>
                </a>
                <p class="admin-sidebar__label">Workspace</p>
                <nav class="admin-nav" aria-label="Admin navigation" data-admin-nav>
                    <a href="{{ route('admin.dashboard') }}" @class(['is-active' => request()->routeIs('admin.dashboard')]) @if (request()->routeIs('admin.dashboard')) aria-current="page" @endif>
                        <span class="admin-nav__icon" aria-hidden="true">⌂</span> Dashboard
                    </a>
                    <a href="{{ route('admin.content.edit', ['section' => 'rooms']) }}#rooms-fields" @class(['is-active' => request()->routeIs('admin.content.edit') && request()->query('section') === 'rooms']) @if (request()->routeIs('admin.content.edit') && request()->query('section') === 'rooms') aria-current="page" @endif>
                        <span class="admin-nav__icon" aria-hidden="true">▤</span> Rooms
                    </a>
                    <a href="{{ route('admin.contacts.index') }}" @class(['is-active' => request()->routeIs('admin.contacts.*')]) @if (request()->routeIs('admin.contacts.*')) aria-current="page" @endif>
                        <span class="admin-nav__icon" aria-hidden="true">✉</span> Contact
                        @if (($unreadMessages ?? 0) > 0)<span class="admin-nav__badge">{{ $unreadMessages }}</span>@endif
                    </a>
                    <a href="{{ route('admin.content.edit', ['section' => 'gallery']) }}#gallery-fields" @class(['is-active' => request()->routeIs('admin.content.edit') && request()->query('section') === 'gallery']) @if (request()->routeIs('admin.content.edit') && request()->query('section') === 'gallery') aria-current="page" @endif>
                        <span class="admin-nav__icon" aria-hidden="true">▧</span> Gallery
                    </a>
                    <a href="{{ route('admin.settings.edit') }}" @class(['is-active' => request()->routeIs('admin.settings.*')]) @if (request()->routeIs('admin.settings.*')) aria-current="page" @endif>
                        <span class="admin-nav__icon" aria-hidden="true">⚙</span> Settings
                    </a>
                </nav>
                <div class="admin-sidebar__bottom">
                    <a class="admin-sidebar__site-link" href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">View website <span aria-hidden="true">↗</span></a>
                    <div class="admin-user">
                        <span class="admin-user__avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                        <span class="admin-user__details"><strong>{{ auth()->user()->name }}</strong><small>Administrator</small></span>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}" data-admin-logout>
                        @csrf
                        <button class="admin-logout" type="submit"><span aria-hidden="true">↪</span> Log out</button>
                    </form>
                </div>
            </aside>
            <button class="admin-sidebar-backdrop" type="button" aria-label="Close admin navigation" data-admin-backdrop></button>

            <div class="admin-workspace">
                <header class="admin-topbar" data-admin-topbar>
                    <button class="admin-menu-toggle" type="button" aria-expanded="false" aria-controls="admin-sidebar" aria-label="Open admin navigation" data-admin-menu-toggle>
                        <span></span><span></span><span></span>
                    </button>
                    <p class="admin-topbar__section">@yield('admin-context', 'Workspace')</p>
                    <div class="admin-topbar__actions">
                        <time class="admin-clock" datetime="{{ now()->toIso8601String() }}" data-admin-clock>{{ now()->format('D, M j · H:i:s') }}</time>
                        <button class="admin-toolbar-button" type="button" aria-label="Enter full screen" title="Enter full screen" data-fullscreen-toggle>
                            <span aria-hidden="true">⛶</span>
                        </button>
                        <span class="admin-fullscreen-status" role="status" aria-live="polite" data-fullscreen-status></span>
                    </div>
                </header>
                <main class="admin-main">
                    @yield('content')
                </main>
            </div>
        </div>
    @else
        <main class="admin-main admin-main--guest">
            @yield('content')
        </main>
    @endauth
</body>
</html>
