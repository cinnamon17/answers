<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Answer;
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

        $response = $this->get('/');
            
            $response->assertSee($question->title);
            $response->assertSee($question->content);

    }

    public function test_guest_can_list_all_answers(){


        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $answer = Answer::factory()->create([

            'question_id' => $question->id,
            'user_id' => $user->id
        ]);

        $response = $this->get('/');
            
            $response->assertSee($question->title);
            $response->assertSee($question->content);
            $response->assertSee($answer->content);

    }

    public function test_guest_view_can_be_rendered(){

        $question = Question::factory()->create();
        $answer = Answer::factory()->create();

        $view = $this->view('guest.index', ['questions' => $question->all(), 'answers' => $answer->all()]);

        $view->assertSee($question->title);
        $view->assertSee($question->content);
        $view->assertSee($answer->content);
    }
}
