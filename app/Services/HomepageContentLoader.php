<?php

namespace App\Services;

use App\Models\HomepageContent;

class HomepageContentLoader
{
    /**
     * Load default homepage content with any saved edits applied.
     *
     * @return array<string, mixed>
     */
    public function load(): array
    {
        return array_replace_recursive(
            config('homepage'),
            HomepageContent::query()->find(1)?->content ?? [],
        );
    }
}