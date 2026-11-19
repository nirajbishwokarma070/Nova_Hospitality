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
    <header class="admin-topbar">
        <a class="admin-brand" href="{{ route('admin.content.edit') }}" aria-label="Nova Hospitality admin">
            <img src="{{ asset('images/nova-hospitality-logo.jpg') }}" alt="Nova Hospitality" width="512" height="240">
            <span>Admin</span>
        </a>
        <div class="admin-topbar__actions">
            @auth
                <a class="admin-link" href="{{ route('home') }}" target="_blank" rel="noopener">View website <span aria-hidden="true">↗</span></a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="admin-link admin-link--button" type="submit">Sign out</button>
                </form>
            @endauth
        </div>
    </header>
    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
