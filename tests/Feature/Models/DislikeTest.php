<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Dislike;

class DislikeTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_model_dislike_exists()
    {
        $dislike = Dislike::factory()->create();

        $this->assertModelExists($dislike);

    }

    public function test_dislikes_table_belongs_to_answer_table(){

        $dislike = Dislike::factory()->create();

        $this->assertInstanceOf(Answer::class, $dislike->answer);
    }

    public function test_dislikes_table_belongs_to_question_table(){

        $dislike = Dislike::factory()->create();

        $this->assertInstanceOf(Question::class, $dislike->question);
    }
}
