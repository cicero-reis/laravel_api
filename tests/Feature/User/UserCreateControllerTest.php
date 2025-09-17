<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();
    }

    public function test_can_create_user()
    {
        $payload = [
            'name' => 'User Name',
            'email' => 'user@gmail.com',
            'role' => 'user'
        ];

        $response = $this->postJson('/api/v1/users', $payload);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'email',
            'created_at',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'User Name',
            'email' => 'user@gmail.com',
        ]);
    }

    public function test_create_task_validation_error()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/users', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }
}
