<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory()->create([

            'id' => 1
        ]);

        \App\Models\Question::factory(10)->create([

            'user_id' => 1
        ]);

        \App\Models\Answer::factory()->create([

            'user_id' => 1,
            'question_id' => 1,
        ]);

        \App\Models\User::factory()->create([

            'id' => 2
        ]);

        \App\Models\Question::factory(2)->create([

            'user_id' => 2
        ]);

        \App\Models\Answer::factory()->create([

            'user_id' => 2,
            'question_id' => 2,
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
