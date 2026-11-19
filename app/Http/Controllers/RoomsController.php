<?php

namespace App\Http\Controllers;

use App\Services\HomepageContentLoader;
use Illuminate\Contracts\View\View;

class RoomsController extends Controller
{
    public function __invoke(HomepageContentLoader $contentLoader): View
    {
        $content = $contentLoader->load();

        return view('rooms.index', ['rooms' => $content['rooms']]);
    }
}
