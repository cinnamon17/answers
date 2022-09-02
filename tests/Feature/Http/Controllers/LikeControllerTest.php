<?php

namespace Tests\Feature\Http\Models;

use App\Models\Answer;
use App\Models\Like;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_a_question(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $like = Like::factory()->create([

            'question_id' => $question->id,
            'likes' => 10

        ]);

        $response = $this->actingAs($user)->put("like/$like->id", $like->attributesToArray());
    
        $this->assertDatabaseHas('likes', [
            'question_id' => $question->id,
            'likes' => 11
        ]);

        $this->assertAuthenticated();
        $response->assertSessionHasNoErrors();
        $response->assertStatus(204);
    }

    public function test_user_can_like_an_answer(){

        $user = User::factory()->create();

        $question = Question::factory()->create([

            'user_id' => $user->id
        ]);

        $answer = Answer::factory()->create([

            'user_id' => $user->id,
            'question_id' => $question->id
        ]);

        $like = Like::factory()->create([

            'answer_id' => $answer->id,
            'question_id' => $question->id,
            'likes' => 12

        ]);

        $response = $this->actingAs($user)->put("like/$like->id", $like->attributesToArray());
    
        $this->assertDatabaseHas('likes', [
            'question_id' => $question->id,
            'likes' => 13
        ]);

        $this->assertAuthenticated();
        $response->assertSessionHasNoErrors();
        $response->assertStatus(204);
    }
}

