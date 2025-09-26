<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class TaskUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        Gate::shouldReceive('authorize')->andReturn(true);

        Task::flushEventListeners();
    }

    public function test_update_task_success()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['name' => 'Old Name', 'priority' => 1]);

        $payload = ['name' => 'New Name', 'priority' => 1];

        $response = $this
            ->actingAs($user)
            ->putJson("/api/v1/tasks/{$task->id}", $payload);

        $response
            ->assertStatus(200)
            ->assertJsonFragment(['name' => 'New Name']);
    }

    public function test_update_task_not_found()
    {
        $user = User::factory()->create();

        $payload = ['name' => 'New Name', 'priority' => 1];

        $response = $this
            ->actingAs($user)
            ->putJson('/api/v1/tasks/9999', $payload);

        $response
            ->assertStatus(404)
            ->assertJsonFragment([
                'message' => 'No tasks found',
                'details' => 'error',
                'code' => 404,
            ]);
    }

    public function test_update_task_validation_error()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $payload = [['name' => '', 'priority' => 1]];

        $response = $this
            ->actingAs($user)
            ->putJson("/api/v1/tasks/{$task->id}", $payload);

        $response->assertStatus(422);
    }
}
