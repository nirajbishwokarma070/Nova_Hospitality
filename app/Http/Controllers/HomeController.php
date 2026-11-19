<?php

namespace App\Http\Controllers;

use App\Models\HomepageContent;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $content = array_replace_recursive(config('homepage'), HomepageContent::query()->find(1)?->content ?? []);
        $media = array_merge(
            [$content['hero'], $content['about'], $content['rooms']],
            $content['experience']['services'],
            $content['gallery']['images'],
        );
        $credits = collect($media)
            ->filter(fn (array $image): bool => filled($image['credit'] ?? null))
            ->unique(fn (array $image): string => $image['credit_url'] ?: $image['credit'])
            ->values();

        return view('home', compact('content', 'credits'));
    }
}
