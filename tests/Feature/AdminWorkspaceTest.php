<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminWorkspaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_has_workspace_navigation_and_overview(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        ContactMessage::query()->create([
            'name' => 'A Guest',
            'email' => 'guest@example.com',
            'subject' => 'Room question',
            'message' => 'Please share more information.',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('Rooms')
            ->assertSee('Contact')
            ->assertSee('Gallery')
            ->assertSee('Settings')
            ->assertSee('Recent messages')
            ->assertSee('Room question')
            ->assertSee('data-admin-menu-toggle', false)
            ->assertSee('data-fullscreen-toggle', false)
            ->assertSee('data-admin-clock', false)
            ->assertSee('data-admin-logout', false);
    }

    public function test_contact_inbox_displays_messages_and_can_mark_them_read(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $message = ContactMessage::query()->create([
            'name' => 'A Guest',
            'email' => 'guest@example.com',
            'subject' => 'A question about rooms',
            'message' => 'Could you share current room availability?',
        ]);

        $this->actingAs($admin)
            ->from(route('admin.contacts.index'))
            ->get(route('admin.contacts.index'))
            ->assertOk()
            ->assertSee('A question about rooms')
            ->assertSee('Could you share current room availability?')
            ->assertSee('Mark as read');

        $this->post(route('admin.contacts.read', $message))
            ->assertRedirect(route('admin.contacts.index'))
            ->assertSessionHas('success');

        $this->assertNotNull($message->fresh()->read_at);
    }

    public function test_admin_can_change_password_from_settings(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
            'password' => Hash::make('old-password-123'),
        ]);

        $this->actingAs($admin)
            ->get(route('admin.settings.edit'))
            ->assertOk()
            ->assertSee('Change password');

        $this->put(route('admin.settings.password.update'), [
            'current_password' => 'old-password-123',
            'password' => 'new-password-1234',
            'password_confirmation' => 'new-password-1234',
        ])->assertRedirect(route('admin.settings.edit'))
            ->assertSessionHas('success');

        $this->assertTrue(Hash::check('new-password-1234', $admin->fresh()->password));
    }
}
