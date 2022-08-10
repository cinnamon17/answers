<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Like;
use App\Models\Answer;
use App\Models\Question;

class LikeTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_like_exists()
    {
        $like = Like::factory()->create();

        $this->assertModelExists($like);

    }

    public function test_likes_table_belongs_to_answer_table(){

        $likes = Like::factory()->create();

        $this->assertInstanceOf(Answer::class, $likes->answer);
    }

    public function test_likes_table_belongs_to_question_table(){

        $likes = Like::factory()->create();

        $this->assertInstanceOf(Question::class, $likes->answer);
    }
}
