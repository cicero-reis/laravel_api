<?php

namespace Tests\Feature\Task;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class TaskCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        Gate::shouldReceive('authorize')->andReturn(true);
    }

    public function test_can_create_task()
    {
        $user = User::factory()->create();

        $payload = [
            'name' => 'Test Task',
            "priority" => 1
        ];

        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/tasks', $payload);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            "id",
            "name",
            "is_completed",
            "created_at",
            "updated_at",
            "delivery_status" => [
                "value",
                "color"
            ],
            "user"
        ]);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
        ]);
    }

    public function test_create_task_validation_error()
    {
        $user = User::factory()->create();

        $payload = [];

        $response = $this
            ->actingAs($user)
            ->postJson('/api/v1/tasks', $payload);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['name']);
    }
}
