<?php

namespace App\Http\Controllers;

use App\Models\HomepageContent;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminContentController extends Controller
{
    public function edit(): View
    {
        $content = array_replace_recursive(
            config('homepage'),
            HomepageContent::query()->find(1)?->content ?? [],
        );

        return view('admin.homepage', [
            'content' => $content,
            'unreadMessages' => ContactMessage::query()->whereNull('read_at')->count(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero.title_first' => ['required', 'string', 'max:80'],
            'hero.title_second' => ['required', 'string', 'max:80'],
            'hero.intro' => ['required', 'string', 'max:300'],
            'hero.credit' => ['nullable', 'string', 'max:120'],
            'hero.credit_url' => ['nullable', 'url', 'max:2048'],
            'hero.image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'about.title_first' => ['required', 'string', 'max:80'],
            'about.title_second' => ['required', 'string', 'max:80'],
            'about.intro' => ['required', 'string', 'max:300'],
            'about.description' => ['required', 'string', 'max:600'],
            'about.image_alt' => ['required', 'string', 'max:180'],
            'about.credit' => ['nullable', 'string', 'max:120'],
            'about.credit_url' => ['nullable', 'url', 'max:2048'],
            'about.image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'rooms.title_first' => ['required', 'string', 'max:80'],
            'rooms.title_second' => ['required', 'string', 'max:80'],
            'rooms.intro' => ['required', 'string', 'max:300'],
            'rooms.draft_notice' => ['required', 'string', 'max:400'],
            'rooms.image_alt' => ['required', 'string', 'max:180'],
            'rooms.credit' => ['nullable', 'string', 'max:120'],
            'rooms.credit_url' => ['nullable', 'url', 'max:2048'],
            'rooms.image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'rooms.types' => ['required', 'array', 'size:4'],
            'rooms.types.*.name' => ['required', 'string', 'max:100'],
            'rooms.types.*.description' => ['required', 'string', 'max:400'],
            'rooms.types.*.price' => ['required', 'string', 'max:100'],
            'rooms.types.*.services' => ['required', 'string', 'max:400'],
            'rooms.types.*.availability' => ['required', 'string', 'max:120'],
            'experience.title_first' => ['required', 'string', 'max:80'],
            'experience.title_second' => ['required', 'string', 'max:80'],
            'experience.intro' => ['required', 'string', 'max:300'],
            'experience.services' => ['required', 'array', 'size:3'],
            'experience.services.*.title' => ['required', 'string', 'max:100'],
            'experience.services.*.description' => ['required', 'string', 'max:300'],
            'experience.services.*.image_alt' => ['required', 'string', 'max:180'],
            'experience.services.*.credit' => ['nullable', 'string', 'max:120'],
            'experience.services.*.credit_url' => ['nullable', 'url', 'max:2048'],
            'experience.services.*.image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'gallery.title_first' => ['required', 'string', 'max:80'],
            'gallery.title_second' => ['required', 'string', 'max:80'],
            'gallery.intro' => ['required', 'string', 'max:300'],
            'gallery.images' => ['required', 'array', 'size:6'],
            'gallery.images.*.caption' => ['required', 'string', 'max:100'],
            'gallery.images.*.alt' => ['required', 'string', 'max:180'],
            'gallery.images.*.credit' => ['nullable', 'string', 'max:120'],
            'gallery.images.*.credit_url' => ['nullable', 'url', 'max:2048'],
            'gallery.images.*.image_upload' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'contact.title_first' => ['required', 'string', 'max:80'],
            'contact.title_second' => ['required', 'string', 'max:80'],
            'contact.intro' => ['required', 'string', 'max:300'],
        ]);

        $record = HomepageContent::query()->find(1) ?? new HomepageContent;

        if (! $record->exists) {
            $record->id = 1;
        }
        $current = array_replace_recursive(config('homepage'), $record->content ?? []);
        $replacedImages = [];

        $content = [
            'hero' => [
                'title_first' => $validated['hero']['title_first'],
                'title_second' => $validated['hero']['title_second'],
                'intro' => $validated['hero']['intro'],
                'image' => $this->storeImage($request->file('hero.image_upload'), $current['hero']['image'], $replacedImages),
                'credit' => $validated['hero']['credit'] ?? '',
                'credit_url' => $validated['hero']['credit_url'] ?? '',
            ],
            'about' => [
                'title_first' => $validated['about']['title_first'],
                'title_second' => $validated['about']['title_second'],
                'intro' => $validated['about']['intro'],
                'description' => $validated['about']['description'],
                'image' => $this->storeImage($request->file('about.image_upload'), $current['about']['image'], $replacedImages),
                'image_alt' => $validated['about']['image_alt'],
                'credit' => $validated['about']['credit'] ?? '',
                'credit_url' => $validated['about']['credit_url'] ?? '',
            ],
            'rooms' => [
                'title_first' => $validated['rooms']['title_first'],
                'title_second' => $validated['rooms']['title_second'],
                'intro' => $validated['rooms']['intro'],
                'draft_notice' => $validated['rooms']['draft_notice'],
                'image' => $this->storeImage($request->file('rooms.image_upload'), $current['rooms']['image'], $replacedImages),
                'image_alt' => $validated['rooms']['image_alt'],
                'credit' => $validated['rooms']['credit'] ?? '',
                'credit_url' => $validated['rooms']['credit_url'] ?? '',
                'types' => array_map(static fn (array $room): array => [
                    'name' => $room['name'],
                    'description' => $room['description'],
                    'price' => $room['price'],
                    'services' => $room['services'],
                    'availability' => $room['availability'],
                ], $validated['rooms']['types']),
            ],
            'experience' => [
                'title_first' => $validated['experience']['title_first'],
                'title_second' => $validated['experience']['title_second'],
                'intro' => $validated['experience']['intro'],
                'services' => [],
            ],
            'gallery' => [
                'title_first' => $validated['gallery']['title_first'],
                'title_second' => $validated['gallery']['title_second'],
                'intro' => $validated['gallery']['intro'],
                'images' => [],
            ],
            'contact' => [
                'title_first' => $validated['contact']['title_first'],
                'title_second' => $validated['contact']['title_second'],
                'intro' => $validated['contact']['intro'],
            ],
        ];

        foreach ($validated['experience']['services'] as $index => $service) {
            $content['experience']['services'][] = [
                'title' => $service['title'],
                'description' => $service['description'],
                'image' => $this->storeImage(
                    $request->file("experience.services.$index.image_upload"),
                    $current['experience']['services'][$index]['image'],
                    $replacedImages,
                ),
                'image_alt' => $service['image_alt'],
                'credit' => $service['credit'] ?? '',
                'credit_url' => $service['credit_url'] ?? '',
            ];
        }

        foreach ($validated['gallery']['images'] as $index => $image) {
            $content['gallery']['images'][] = [
                'image' => $this->storeImage(
                    $request->file("gallery.images.$index.image_upload"),
                    $current['gallery']['images'][$index]['image'],
                    $replacedImages,
                ),
                'caption' => $image['caption'],
                'alt' => $image['alt'],
                'credit' => $image['credit'] ?? '',
                'credit_url' => $image['credit_url'] ?? '',
            ];
        }

        $record->content = $content;
        $record->save();

        foreach (array_unique($replacedImages) as $image) {
            if (str_starts_with($image, 'storage/homepage/')) {
                Storage::disk('public')->delete(substr($image, strlen('storage/')));
            }
        }

        $section = in_array($request->input('section'), ['rooms', 'gallery'], true)
            ? $request->input('section')
            : null;

        return redirect()
            ->route('admin.content.edit', array_filter(['section' => $section]))
            ->with('success', 'Homepage content updated.');
    }

    /**
     * @param  list<string>  $replacedImages
     */
    private function storeImage(?UploadedFile $upload, string $currentPath, array &$replacedImages): string
    {
        if (! $upload) {
            return $currentPath;
        }

        $replacedImages[] = $currentPath;

        return 'storage/'.$upload->storePublicly('homepage', 'public');
    }
}
