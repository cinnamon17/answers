<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\UserMessage;

use Tests\TestCase;

class UserMessageTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_user_message_exists()
    {
        $userMessage = UserMessage::factory()->create();

        $this->assertModelExists($userMessage);
    }
}
