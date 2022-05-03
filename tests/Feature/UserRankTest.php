<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRankTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_get_user_rank()
    {
        // $this->withoutExceptionHandling();

        $this->json('GET', 'api/v1/user/43/karma-position?num=9')
            ->assertStatus(200)
            ->assertJsonStructure([
                "data" => [
                    '*' => [
                        'id',
                        "karma_score",
                        "position",
                        "image_url"
                    ]
                ]
            ]);
    }

    public function test_if_id_not_exist()
    {
        $this->json('GET', 'api/v1/user/-1/karma-position?num=9')
            ->assertStatus(404)
            ->assertJsonStructure([
                "message"
            ]);
    }
}
