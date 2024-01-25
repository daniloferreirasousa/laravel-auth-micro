<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function test_get_users_unauthenticated()
    {
       $response = $this->getJson('/users');

       $response->assertStatus(401);
    }

    public function test_get_users_unauthorized()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->getJson('/users');

        $response->assertStatus(403);
    }

    public function test_get_users()
    {
        $permission = Permission::factory()->create([
            'name' => 'users'
        ]);

        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $user->permissions()->attach($permission);

        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->getJson('/users');

        $response->assertStatus(200);
    }

    public function test_count_users()
    {
        $permission = Permission::factory()->create([
            'name' => 'users'
        ]);

        $users = User::factory()->count(10)->create();

        $user = User::first();

        $token = $user->createToken('test')->plainTextToken;

        $user->permissions()->attach($permission);

        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->getJson('/users');

        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }


    public function test_get_user()
    {
        $permission = Permission::factory()->create([
            'name' => 'users'
        ]);

        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $user->permissions()->attach($permission);

        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->getJson("/users/{$user->uuid}");

        $response->assertStatus(200);
    }

    public function test_get_fail_user()
    {
        $permission = Permission::factory()->create([
            'name' => 'users'
        ]);

        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $user->permissions()->attach($permission);

        $response = $this->withHeaders(['Authorization' => "Bearer {$token}"])->getJson("/users/faker_value");

        $response->assertStatus(404);
    }



}
