<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminContactController;
use App\Http\Controllers\AdminContentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/rooms', RoomsController::class)->name('rooms.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('login');
    Route::post('/admin/login', [AdminAuthController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('admin.login.store');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function (): void {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::get('/homepage', [AdminContentController::class, 'edit'])->name('content.edit');
        Route::put('/homepage', [AdminContentController::class, 'update'])->name('content.update');
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::post('/contacts/{contactMessage}/read', [AdminContactController::class, 'markRead'])->name('contacts.read');
        Route::get('/settings', [AdminSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password.update');
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
    });
