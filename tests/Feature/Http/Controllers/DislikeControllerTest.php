<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Answer;
use App\Models\Dislike;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DislikeControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_user_can_dislike_a_question(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);


        $dislike = Dislike::factory()->create([

            'question_id' => $question->id,
            'dislikes' => 12

        ]);

        $response = $this->actingAs($user)->put("dislike/$dislike->id", $dislike->attributesToArray());
    
        $this->assertDatabaseHas('dislikes', [
            'question_id' => $question->id,
            'dislikes' => 13
        ]);

        $this->assertAuthenticated();
        $response->assertSessionHasNoErrors();
        $response->assertStatus(204);
    }

    public function test_user_can_dislike_an_answer(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $answer = Answer::factory()->create([

            'user_id' => $user->id,
            'question_id' => $question->id
        ]);

        $dislike = Dislike::factory()->create([

            'answer_id' => $answer->id,
            'question_id' => $question->id,
            'dislikes' => 12

        ]);

        $response = $this->actingAs($user)->put("dislike/$dislike->id", $dislike->attributesToArray());
    
        $this->assertDatabaseHas('dislikes', [
            'question_id' => $question->id,
            'dislikes' => 13
        ]);

        $this->assertAuthenticated();
        $response->assertSessionHasNoErrors();
        $response->assertStatus(204);
    }
}
