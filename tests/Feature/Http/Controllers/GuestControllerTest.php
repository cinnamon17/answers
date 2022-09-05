<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_guest_can_list_all_questions(){


        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $second_user = User::factory()->create();

        $second_question = Question::factory()->create([

            'user_id' => $second_user->id
        ]);

        $this->get('/')
            ->assertSee($question->title)
            ->assertSee($question->content)
            ->assertSee($second_question->title)
            ->assertSee($second_question->content);

    }
}
