<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Answer;
use App\Models\User;


class AnswerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_answer_a_question(){

        $user = User::factory()->create();
        $answer = Answer::factory()->create();

        $response = $this->actingAs($user)
                         ->post('answer', $answer->attributesToArray());

        $this->assertAuthenticated();
        
        $this->assertDatabaseHas('answers', [

            'content' => $answer->getAttribute('content'),
            'question_id' => $answer->getAttribute('question_id'),
            'user_id' => $answer->getAttribute('user_id')
        
        ]);

        $response->assertStatus(201);
    }
}
