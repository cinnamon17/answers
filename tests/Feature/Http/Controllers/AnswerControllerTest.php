<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;


class AnswerControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_user_can_store_an_answer(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);
            
        $answer = Answer::factory()->create([
            
            'question_id' => $question->id,
            'user_id' => $question->user_id,
        ]);

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

    public function test_user_can_destroy_an_answer(){

        $user = User::factory()->create();
        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);
            
        $answer = Answer::factory()->create([
            
            'question_id' => $question->id,
            'user_id' => $question->user_id,
        ]);

        $this->actingAs($user)
             ->delete("answer/$answer->id")
             ->assertRedirect('answer');
    }

    public function test_user_can_update_an_answer(){

        $user = User::factory()->create();
        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $answer = Answer::factory()->create([

            'user_id' => $question->user_id,
            'question_id' => $question->id
        ]);

        $data = [
            'content' => 'test answer'
        ];

       $response = $this->actingAs($user)
            ->put("answer/$answer->id", $data);

        $this->assertDatabaseHas('answers', $data);

        $response->assertRedirect("answer/$answer->id/edit");
        
    }

    public function test_view_create_exists(){

        $view = $this->view('answer.create', ['question_id' => 'data']);
            $view->assertSee('');
    }

    public function test_user_can_answer_from_create_view(){

        $user = User::factory()->create();

        $answer = Answer::factory()->create([

            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get('answer/create')
            ->assertSee('form');

    }
}
