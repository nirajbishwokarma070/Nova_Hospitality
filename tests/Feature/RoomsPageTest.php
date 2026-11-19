<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_rooms_page_discloses_draft_status_and_shows_four_proposed_categories(): void
    {
        $response = $this->get(route('rooms.index'));

        $response->assertOk()
            ->assertSee('Room details, rates, services, and availability must be confirmed with Nova Hospitality.')
            ->assertSee('Standard Room')
            ->assertSee('Deluxe Room')
            ->assertSee('Twin Room')
            ->assertSee('Family Room')
            ->assertSee('Contact for rates')
            ->assertSee('Room details')
            ->assertSee('Rate')
            ->assertSee('Availability')
            ->assertSee('Contact Nova Hospitality to confirm.')
            ->assertSee('Not confirmed. Contact Nova Hospitality for current information.')
            ->assertSee('Illustrative reference · not a Nova room');

        self::assertSame(4, preg_match_all('/<article class="room-option">/', (string) $response->getContent()));
    }

    public function test_navigation_links_to_the_rooms_page(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('href="'.route('rooms.index').'"', false);
    }
}
