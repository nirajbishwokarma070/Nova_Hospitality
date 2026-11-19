<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Events\MessageSent;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_has_six_main_sections_and_the_company_contact_details(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('class="site-header site-header--home"', false)
            ->assertSee('A New Chapter')
            ->assertSee('Hospitality That')
            ->assertSee('Explore these proposed room categories.')
            ->assertSee('Experience the')
            ->assertSee('Explore Our')
            ->assertSee('Get in')
            ->assertSee('href="'.route('rooms.index').'"', false)
            ->assertSee('9855016037')
            ->assertSee('sagarshrestha813@gmail.com')
            ->assertSee('href="mailto:sagarshrestha813@gmail.com"', false)
            ->assertSee('href="https://wa.me/9779855016037"', false)
            ->assertSee('href="tel:9855016037"', false)
            ->assertSee('href="https://www.facebook.com/"', false)
            ->assertSee('href="https://www.instagram.com/"', false)
            ->assertSee('href="https://www.youtube.com/"', false);

        self::assertSame(6, preg_match_all('/<section\b/', (string) $response->getContent()));
    }

    public function test_contact_form_reports_validation_errors_without_sending_email(): void
    {
        Event::fake([MessageSent::class]);

        $response = $this->from(route('home').'#contact')->post(route('contact.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'subject' => "Bad subject\r\nBcc: guest@example.com",
            'message' => '',
        ]);

        $response->assertRedirect(route('home').'#contact')
            ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);

        Event::assertNotDispatched(MessageSent::class);
    }

    public function test_valid_contact_message_is_emailed_to_the_business_address(): void
    {
        Event::fake([MessageSent::class]);

        $response = $this->post(route('contact.store'), [
            'name' => 'A Guest',
            'email' => 'guest@example.com',
            'subject' => 'A question',
            'message' => 'I would like to know more.',
        ]);

        $response->assertRedirect(route('home').'#contact')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'A Guest',
            'email' => 'guest@example.com',
            'subject' => 'A question',
            'message' => 'I would like to know more.',
        ]);

        Event::assertDispatched(MessageSent::class, static function (MessageSent $event): bool {
            $recipients = $event->message->getTo();

            return count($recipients) === 1
                && $recipients[0]->getAddress() === 'sagarshrestha813@gmail.com'
                && $event->message->getSubject() === 'A question';
        });
    }
}
