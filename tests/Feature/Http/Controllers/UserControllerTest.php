<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_create_a_question(){

        $user = User::factory()->create();
        $question = Question::factory()->create();

        $response = $this->actingAs($user)->post('/', $question->attributesToArray());

        $this->assertAuthenticated();

        $this->assertDatabaseHas('questions', [

            'title' => $question->getAttribute('title'),
            'content' => $question->getAttribute('content')
        
        ]);

        $response->assertStatus(201);
    }

    public function test_user_can_answer_a_question(){

        $user = User::factory()->create();
        $answer = Answer::factory()->create();

       $response = $this->actingAs($user)->post('/', $answer->attributesToArray());

        $this->assertAuthenticated();
        
        $this->assertDatabaseHas('answers', [

            'content' => $answer->getAttribute('content')
        
        ]);

    }
}
