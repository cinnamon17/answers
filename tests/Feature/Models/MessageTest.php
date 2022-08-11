<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_message_exists()
    {
        $message = Message::factory()->create();

        $this->assertModelExists($message);
    }

    public function test_messages_has_many_usermessages(){


        $message = Message::factory()->create();

        $this->assertInstanceOf(Collection::class, $message->usermessage);

    }

}
