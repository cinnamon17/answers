<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Question;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_store_a_question(){

        $user = User::factory()->create();
        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)
                         ->post('/question', $question->attributesToArray())
                         ->assertRedirect('question');

        $this->assertAuthenticated();

        $this->assertDatabaseHas('questions', [

            'title' => $question->getAttribute('title'),
            'content' => $question->getAttribute('content')
        
        ]);

    }

    public function test_user_can_destroy_a_question(){

        $user = User::factory()->create();
        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->delete("question/$question->id");

        $this->assertAuthenticated();

        $response->assertRedirect('question');

        $this->assertDatabaseMissing('questions', $question->attributesToArray());

    }

    public function test_user_can_update_a_question(){

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
             ->assertRedirect("question");

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
    
    public function test_user_can_edit_a_question(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get("question/$question->id/edit")
            ->assertSee($question->title)
            ->assertSee($question->content);
    }

    public function test_edit_view_exists(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $this->view('question.edit', ['question' => $question])
                ->assertSee($question->title)
                ->assertSee($question->content);
    }

    public function test_user_can_create_a_question(){

        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('question/create')
            ->assertStatus(200);

    }

    public function test_create_view_exists(){

        $user = User::factory()->create();

        $this->view('question.create')
            ->assertSee('form');
    }

    public function test_user_can_show_a_question(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get("question/$question->id")
            ->assertSessionHasNoErrors()
            ->assertSee($question->title)
            ->assertSee($question->content);

    }
    public function test_show_view_exists(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $answer = Answer::factory()->create();

        $view = $this->view('question.show', ['question' => $question, 'answer' => $answer]);
            $view->assertSee('div');
    }

}
