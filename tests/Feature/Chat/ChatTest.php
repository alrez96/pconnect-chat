<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test chat page is displayed
     */
    public function test_chat_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/chatroom');

        $response->assertOk();

        $response->assertInertia(
            fn (Assert $page) => $page
                ->has('contacts', 0)
        );
    }

    /**
     * Test chat form page is displayed
     */
    public function test_chat_form_page_is_displayed(): void
    {
        $userFrom = User::factory()->create();
        $userTo = User::factory(2)->create();

        $response = $this
            ->actingAs($userFrom)
            ->get('/chatroom/' . $userTo[0]->id);

        $response->assertOk();

        $response->assertInertia(
            fn (Assert $page) => $page
                ->has('contacts', 2)
                ->has('chat_id')
                ->has('messages')
        );
    }

    /**
     * Test user can send message
     */
    public function test_user_can_send_message(): void
    {
        $userFrom = User::factory()->create();
        $userTo = User::factory(2)->create();

        $response = $this
            ->actingAs($userFrom)
            ->post('/chatroom/' . $userTo[0]->id, [
                'message' => 'Test Message',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/chatroom/' . $userTo[0]->id);

        $this->assertDatabaseHas('messages', [
            'message' => 'Test Message',
        ]);
    }
}
