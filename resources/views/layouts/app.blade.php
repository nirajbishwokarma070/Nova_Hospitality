<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#171a19">
    <meta name="description" content="Nova Hospitality — a new place to slow down, feel at home, and make every stay memorable. Discover our vision for thoughtful hospitality in Kawasoti, Nepal.">
    <title>@yield('title', 'Nova Hospitality — A New Chapter in Hospitality')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/nova-hospitality-logo.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <x-navbar />
    <main id="main-content">
        @yield('content')
    </main>
    <x-footer />
</body>
</html>
