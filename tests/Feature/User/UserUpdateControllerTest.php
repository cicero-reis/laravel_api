<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_user_success()
    {
        $user = User::factory()->create(['name' => 'Old Name', 'email' => 'teste@gmail.com']);

        $payload = ['name' => 'New Name', 'email' => 'teste@gmail.com'];

        $response = $this->putJson("/api/v1/users/{$user->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Name', 'email' => 'teste@gmail.com']);
    }

    public function test_update_user_not_found()
    {
        $payload = ['name' => 'Old Name', 'email' => 'teste@gmail.com'];

        $response = $this->putJson('/api/v1/users/9999', $payload);

        $response->assertStatus(404)
            ->assertJsonFragment([
                'message' => 'No user found',
                'details' => 'error',
                'code' => 404,
            ]);
    }

    public function test_update_user_validation_error()
    {
        $user = User::factory()->create();

        $payload = ['name' => ''];

        // $response = $this->actingAs($user)->putJson("/api/v1/tasks/{$user->id}", $payload);
        $response = $this->putJson("/api/v1/users/{$user->id}", $payload);

        $response->assertStatus(422);
    }
}
