<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Coin;

class CoinTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test 
     *
     */
    public function test_model_coin_exists()
    {
        $coin = Coin::factory()->create();

        $this->assertModelExists($coin);

    }
    public function test_coins_table_belongs_to_users_table()
    {

        $coin = Coin::factory()->create();

        $this->assertInstanceOf(User::class, $coin->user);

    }
}
