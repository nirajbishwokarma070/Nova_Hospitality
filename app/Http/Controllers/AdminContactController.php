<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminContactController extends Controller
{
    public function index(): View
    {
        return view('admin.contacts', [
            'messages' => ContactMessage::query()->latest()->paginate(15),
            'unreadMessages' => ContactMessage::query()->whereNull('read_at')->count(),
        ]);
    }

    public function markRead(ContactMessage $contactMessage): RedirectResponse
    {
        if ($contactMessage->read_at === null) {
            $contactMessage->forceFill(['read_at' => now()])->save();
        }

        return back()->with('success', 'Message marked as read.');
    }
}
