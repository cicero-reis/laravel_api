<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_existing_user_returns_no_content()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/v1/users/{$user->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_delete_non_existing_user_returns_not_found()
    {
        $response = $this->deleteJson('/api/v1/users/999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'No user found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
