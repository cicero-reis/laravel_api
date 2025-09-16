<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFindControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_returns_user_by_id()
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/v1/users/'.$user->id);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
        ]);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at->format('d/m/Y H:i:s'),
        ]);
    }

    public function test_show_returns_404_when_no_user_found()
    {
        $response = $this->getJson('/api/v1/users/999');

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'No user found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
