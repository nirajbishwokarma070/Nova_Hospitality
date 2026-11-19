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
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('login'));

        $this->get(route('login'))->assertOk();
    }

    public function test_rooms_and_gallery_editor_use_compact_summaries(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin)
            ->get(route('admin.content.edit'))
            ->assertOk()
            ->assertSee('Section 03')
            ->assertSee('Section 05')
            ->assertSee('Page heading, notice and feature photo')
            ->assertSee('Room 1 · Standard Room')
            ->assertSee('Gallery heading and supporting text')
            ->assertSee('Image 1')
            ->assertDontSee('Section 01')
            ->assertDontSee('Section 02')
            ->assertDontSee('Section 04')
            ->assertDontSee('Section 06');
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

    public function test_admin_can_update_rooms_and_gallery_without_changing_other_sections(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $existingContent = config('homepage');
        $existingContent['hero']['title_first'] = 'Previously saved hero copy';
        $existingContent['about']['intro'] = 'Previously saved about copy';
        $existingContent['experience']['intro'] = 'Previously saved experience copy';
        $existingContent['contact']['intro'] = 'Previously saved contact copy';
        $existingRecord = new HomepageContent;
        $existingRecord->id = 1;
        $existingRecord->content = $existingContent;
        $existingRecord->save();

        $payload = $this->editorPayload();
        $payload['section'] = 'rooms';
        $payload['rooms']['image_upload'] = $this->fakePng();
        $payload['rooms']['types'][0]['price'] = 'NPR 2,500 (test)';
        $payload['rooms']['types'][0]['availability'] = 'Available (test)';
        $payload['gallery']['images'][0]['caption'] = 'Gallery caption (test)';
        $payload['gallery']['images'][0]['image_upload'] = $this->fakePng();

        $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->put(route('admin.content.update'), $payload)
            ->assertRedirect(route('admin.content.edit', ['section' => 'rooms']))
            ->assertSessionHas('success');

        $savedContent = HomepageContent::query()->firstOrFail()->content;

        self::assertSame('Previously saved hero copy', $savedContent['hero']['title_first']);
        self::assertSame('Previously saved about copy', $savedContent['about']['intro']);
        self::assertSame('Previously saved experience copy', $savedContent['experience']['intro']);
        self::assertSame('Previously saved contact copy', $savedContent['contact']['intro']);
        self::assertSame('NPR 2,500 (test)', $savedContent['rooms']['types'][0]['price']);
        self::assertSame('Available (test)', $savedContent['rooms']['types'][0]['availability']);
        self::assertSame('Gallery caption (test)', $savedContent['gallery']['images'][0]['caption']);
        self::assertStringStartsWith('storage/homepage/', $savedContent['rooms']['image']);
        self::assertStringStartsWith('storage/homepage/', $savedContent['gallery']['images'][0]['image']);
        Storage::disk('public')->assertExists(substr($savedContent['rooms']['image'], strlen('storage/')));
        Storage::disk('public')->assertExists(substr($savedContent['gallery']['images'][0]['image'], strlen('storage/')));

        $this->get(route('rooms.index'))->assertOk()->assertSee('NPR 2,500 (test)');
        $this->get(route('home'))->assertOk()->assertSee('Previously saved hero copy');
    }

    public function test_admin_content_validation_rejects_non_image_uploads(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['is_admin' => true]);
        $payload = $this->editorPayload();
        $payload['rooms']['image_upload'] = UploadedFile::fake()->create('notes.txt', 2, 'text/plain');

        $this->actingAs($admin)
            ->from(route('admin.content.edit'))
            ->put(route('admin.content.update'), $payload)
            ->assertRedirect(route('admin.content.edit'))
            ->assertSessionHasErrors('rooms.image_upload');

        $this->assertDatabaseCount('homepage_contents', 0);
    }

    private function editorPayload(): array
    {
        $content = config('homepage');

        return [
            'rooms' => [
                'title_first' => $content['rooms']['title_first'],
                'title_second' => $content['rooms']['title_second'],
                'intro' => $content['rooms']['intro'],
                'draft_notice' => $content['rooms']['draft_notice'],
                'image_alt' => $content['rooms']['image_alt'],
                'credit' => $content['rooms']['credit'],
                'credit_url' => $content['rooms']['credit_url'],
                'types' => $content['rooms']['types'],
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
