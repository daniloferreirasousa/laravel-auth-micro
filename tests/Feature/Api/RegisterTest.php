<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_validations_register(): void
    {
        $response = $this->postJson('/register', []);

        $response->assertStatus(422);
    }

    public function test_register(): void
    {
        $response = $this->postJson('/register', [
            'name' => 'Danilo de Andrade',
            'email' => 'danilo@sup.com',
            'password' => '123456',
            'device_name' => 'test',
        ]);

        $response->assertJsonStructure([
            'data' => [
                'identify',
                'name',
                'email',
                'permissions' => [],
            ],
            'token',
        ]);

        $response->assertStatus(201);
    }

}
