<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class QuestionControllerTest extends TestCase
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

        $response = $this->actingAs($user)
                         ->post('/question', $question->attributesToArray())
                         ->assertRedirect('question.index');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('questions', [

            'title' => $question->getAttribute('title'),
            'content' => $question->getAttribute('content')
        
        ]);

    }

    public function test_user_can_delete_a_question(){

        $user = User::factory()->create();
        $question = Question::factory()->create();

        $id = $question->getAttribute('id');

        $response = $this->actingAs($user)->delete("question/$id");

        $this->assertAuthenticated();

        $response->assertStatus(204);

        $this->assertDatabaseMissing('questions', $question->attributesToArray());

    }
}
