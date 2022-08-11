<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class QuestionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_question_exists()
    {
        $question = Question::factory()->create();

        $this->assertModelExists($question);

    }

    public function test_questions_table_belongs_to_users_table(){

        $question = Question::factory()->create();

        $this->assertInstanceOf(User::class, $question->user);

    }

    public function test_questions_table_has_many_answers(){

        $question = Question::factory()->create();

        $this->assertInstanceOf(Collection::class, $question->answer);
    }
 
    public function test_questions_table_has_many_likes(){

        $question = Question::factory()->create();

        $this->assertInstanceOf(Collection::class, $question->likes);
    }

    public function test_questions_table_has_many_dislikes(){

        $question = Question::factory()->create();

        $this->assertInstanceOf(Collection::class, $question->dislikes);
    }
}
