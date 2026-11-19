@extends('layouts.admin')

@section('title', 'Admin sign in — Nova Hospitality')

@section('content')
    <section class="admin-card admin-login" aria-labelledby="admin-title">
        <p class="admin-eyebrow">Nova Hospitality</p>
        <h1 id="admin-title">Admin sign in</h1>
        <p class="admin-description">Sign in to update homepage text and photography.</p>

        <form class="admin-form" method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="admin-field">
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" autocomplete="username" value="{{ old('email') }}" required autofocus @error('email') aria-invalid="true" @enderror>
                @error('email')<span class="admin-error">{{ $message }}</span>@enderror
            </div>
            <div class="admin-field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required @error('password') aria-invalid="true" @enderror>
                @error('password')<span class="admin-error">{{ $message }}</span>@enderror
            </div>
            <button class="admin-button" type="submit">Sign in</button>
        </form>
        <a class="admin-back-link" href="{{ route('home') }}">← Back to website</a>
    </section>
@endsection
