<?php

namespace Tests\Feature;

use App\Models\HomepageContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_require_authentication(): void
    {
        $this->get(route('admin.content.edit'))
            ->assertRedirect(route('login'));

        $this->get(route('login'))->assertOk();
    }

    public function test_regular_users_cannot_sign_in_to_the_admin_panel(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->post(route('admin.login.store'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();

        $this->actingAs($user)
            ->get(route('admin.content.edit'))
            ->assertForbidden();
    }

    public function test_admin_can_update_homepage_copy_and_upload_a_hero_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $payload = $this->editorPayload();
        $payload['hero']['title_first'] = 'A Thoughtful Stay';
        $payload['hero']['image_upload'] = $this->fakePng();

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.content.edit'));

        $this->put(route('admin.content.update'), $payload)
            ->assertRedirect(route('admin.content.edit'))
            ->assertSessionHas('success');

        $savedContent = HomepageContent::query()->firstOrFail()->content;

        self::assertSame('A Thoughtful Stay', $savedContent['hero']['title_first']);
        self::assertStringStartsWith('storage/homepage/', $savedContent['hero']['image']);
        Storage::disk('public')->assertExists(substr($savedContent['hero']['image'], strlen('storage/')));

        $this->get(route('home'))->assertOk()->assertSee('A Thoughtful Stay');
    }

    public function test_admin_content_validation_rejects_non_image_uploads(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $payload = $this->editorPayload();
        $payload['hero']['image_upload'] = UploadedFile::fake()->create('notes.txt', 2, 'text/plain');

        $this->actingAs($admin)
            ->from(route('admin.content.edit'))
            ->put(route('admin.content.update'), $payload)
            ->assertRedirect(route('admin.content.edit'))
            ->assertSessionHasErrors('hero.image_upload');

        $this->assertDatabaseCount('homepage_contents', 0);
    }

    private function editorPayload(): array
    {
        $content = config('homepage');

        return [
            'hero' => [
                'title_first' => $content['hero']['title_first'],
                'title_second' => $content['hero']['title_second'],
                'intro' => $content['hero']['intro'],
                'credit' => $content['hero']['credit'],
                'credit_url' => $content['hero']['credit_url'],
            ],
            'about' => [
                'title_first' => $content['about']['title_first'],
                'title_second' => $content['about']['title_second'],
                'intro' => $content['about']['intro'],
                'description' => $content['about']['description'],
                'image_alt' => $content['about']['image_alt'],
                'credit' => $content['about']['credit'],
                'credit_url' => $content['about']['credit_url'],
            ],
            'experience' => [
                'title_first' => $content['experience']['title_first'],
                'title_second' => $content['experience']['title_second'],
                'intro' => $content['experience']['intro'],
                'services' => array_map(static fn (array $service): array => [
                    'title' => $service['title'],
                    'description' => $service['description'],
                    'image_alt' => $service['image_alt'],
                    'credit' => $service['credit'],
                    'credit_url' => $service['credit_url'],
                ], $content['experience']['services']),
            ],
            'gallery' => [
                'title_first' => $content['gallery']['title_first'],
                'title_second' => $content['gallery']['title_second'],
                'intro' => $content['gallery']['intro'],
                'images' => array_map(static fn (array $image): array => [
                    'caption' => $image['caption'],
                    'alt' => $image['alt'],
                    'credit' => $image['credit'],
                    'credit_url' => $image['credit_url'],
                ], $content['gallery']['images']),
            ],
            'contact' => [
                'title_first' => $content['contact']['title_first'],
                'title_second' => $content['contact']['title_second'],
                'intro' => $content['contact']['intro'],
            ],
        ];
    }

    private function fakePng(): UploadedFile
    {
        $image = base64_decode(
            'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/lSYAAAAASUVORK5CYII=',
            true,
        );

        self::assertIsString($image);

        return UploadedFile::fake()->createWithContent('hero.png', $image);
    }
}
