<?php

namespace App\Http\Controllers;

use App\Models\HomepageContent;
use Illuminate\Contracts\View\View;

class RoomsController extends Controller
{
    public function __invoke(): View
    {
        $content = array_replace_recursive(
            config('homepage'),
            HomepageContent::query()->find(1)?->content ?? [],
        );

        return view('rooms.index', ['rooms' => $content['rooms']]);
    }
}
