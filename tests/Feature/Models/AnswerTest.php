<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Answer;
use App\Models\User;
use App\Models\Question;

class AnswerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_answer_exists()
    {
        $answer = Answer::factory()->create();

        $this->assertModelExists($answer);

    }

    public function test_answers_table_belongs_to_user_table(){

        $answer = Answer::factory()->create();

        $this->assertInstanceOf(User::class, $answer->user );
    }

    public function test_answers_table_belongs_to_questions_table(){

        $answer = Answer::factory()->create();

        $this->assertInstanceOf(Question::class, $answer->question);
    }
}
