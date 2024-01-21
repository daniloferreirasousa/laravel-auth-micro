<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_users(): void
    {
        $users = User::factory()->count(10)->create();

        $response = $this->getJson('/users');

        $response->assertJsonCount(10, 'data');

        $response->assertStatus(200);
    }
}
