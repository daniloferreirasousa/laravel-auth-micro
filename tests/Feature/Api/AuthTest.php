<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * Teste para autenticar o usuário sem envir os dados
     */
    public function test_validations_auth(): void
    {
        $response = $this->postJson('/auth', []);

        $response->assertStatus(422);
    }

    public function test_auth(): void
    {
        $user = User::factory()->create([
            'email' => 'danilo@support.com',
            'password' => '123456',
        ]);

        $response = $this->postJson('/auth', [
            'email' => 'danilo@support.com',
            'password' => '123456',
            'device_name'   => 'test',
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

        $response->assertStatus(200);
    }


    public function test_error_password_auth()
    {
        User::factory()->create([
            'email' => 'danilo@support.com',
            'password' => '123456',
        ]);

        $response = $this->postJson('/auth', [
            'email' => 'danilo@support.com',
            'password' => '123458',
            'device_name'   => 'test',
        ]);

        $response->assertStatus(422);
    }

    public function test_error_logout()
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders(['Authorization' => "Bearer {$token}"])
                        ->postJson("/logout");

        $response->assertStatus(200);
    }

    public function test_error_get_me()
    {
        $response = $this->getJson('/me');

        $response->assertStatus(401);
    }


    public function test_get_me()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders(['Authorization' => "Bearer {$token}"])
                        ->getJson("/me");

        $response->assertStatus(200);
    }

}
