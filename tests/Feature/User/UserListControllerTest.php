<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserListControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_users_list()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'meta',
        ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_index_returns_404_when_no_users_found()
    {
        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'No users found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
