<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_user_exists()
    {
        $user = User::factory()->create();

        $this->assertModelExists($user);

    }

    public function test_users_table_has_many_coins(){

        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->coin);

    }

    public function test_users_table_has_many_answers(){

        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->answer);

    }

    public function test_users_table_has_many_questions(){

        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->question);

    }

    public function test_users_table_has_many_usermessages(){

        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->usermessage);

    }
}
