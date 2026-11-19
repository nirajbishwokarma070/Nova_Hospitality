<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\HomepageContent;
use Illuminate\Contracts\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        $content = array_replace_recursive(
            config('homepage'),
            HomepageContent::query()->find(1)?->content ?? [],
        );
        $unreadMessages = ContactMessage::query()->whereNull('read_at')->count();
        $latestMessages = ContactMessage::query()->latest()->limit(5)->get();

        return view('admin.dashboard', [
            'roomCount' => count($content['rooms']['types']),
            'galleryCount' => count($content['gallery']['images']),
            'messageCount' => ContactMessage::query()->count(),
            'unreadMessages' => $unreadMessages,
            'latestMessages' => $latestMessages,
        ]);
    }
}
