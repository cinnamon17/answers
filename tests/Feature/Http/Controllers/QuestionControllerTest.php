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
        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->post('/question', $question->attributesToArray())
                         ->assertStatus(201)
                         ->assertRedirect('question.index');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('questions', [

            'title' => $question->getAttribute('title'),
            'content' => $question->getAttribute('content')
        
        ]);

    }

    public function test_user_can_delete_a_question(){

        $user = User::factory()->create();
        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $id = $question->getAttribute('id');

        $response = $this->actingAs($user)->delete("question/$id");

        $this->assertAuthenticated();

        $response->assertStatus(204);

        $this->assertDatabaseMissing('questions', $question->attributesToArray());

    }

    public function test_user_can_edit_a_question(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $data = [
            'title' => 'test',
            'content' => 'content'
        ];

        $this->actingAs($user)
             ->put("question/$question->id", $data)
             ->assertRedirect("question/$question->id/edit");

        $this->assertDatabaseHas('questions', $data);
    }

    public function test_user_can_list_all_questions(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $this->actingAs($user)
             ->get('question')
             ->assertStatus(200)
             ->assertSee($question->title)
             ->assertSee($question->content);
    }

}
