@extends('layouts.admin')

@section('title', 'Settings — Nova Hospitality')
@section('admin-context', 'Settings')

@section('content')
    <div class="admin-page-heading">
        <div>
            <p class="admin-eyebrow">Security</p>
            <h1>Settings</h1>
            <p class="admin-description">Update the password for your administrator account.</p>
        </div>
    </div>

    @if (session('success'))
        <p class="admin-notice" role="status">{{ session('success') }}</p>
    @endif
    @if ($errors->any())
        <div class="admin-notice admin-notice--error" role="alert">Please review the highlighted fields and try again.</div>
    @endif

    <section class="admin-card admin-settings-card" aria-labelledby="password-title">
        <div class="admin-card-heading">
            <div>
                <p class="admin-eyebrow">Administrator account</p>
                <h2 id="password-title">Change password</h2>
            </div>
        </div>
        <form class="admin-form admin-settings-form" method="POST" action="{{ route('admin.settings.password.update') }}">
            @csrf
            @method('PUT')
            <div class="admin-field">
                <label for="current-password">Current password</label>
                <input id="current-password" name="current_password" type="password" autocomplete="current-password" required @error('current_password') aria-invalid="true" @enderror>
                @error('current_password')<span class="admin-error">{{ $message }}</span>@enderror
            </div>
            <div class="admin-field">
                <label for="new-password">New password</label>
                <input id="new-password" name="password" type="password" autocomplete="new-password" minlength="12" required @error('password') aria-invalid="true" @enderror>
                <small>Use at least 12 characters.</small>
                @error('password')<span class="admin-error">{{ $message }}</span>@enderror
            </div>
            <div class="admin-field">
                <label for="password-confirmation">Confirm new password</label>
                <input id="password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" minlength="12" required>
            </div>
            <div class="admin-save-row"><button class="admin-button" type="submit">Update password</button></div>
        </form>
    </section>
@endsection
