<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class TaskDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        Gate::shouldReceive('authorize')->andReturn(true);
    }

    public function test_delete_existing_task_returns_no_content()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $response = $this
            ->actingAs($user)
            ->deleteJson("/api/v1/tasks/{$task->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('tasks', ['id' => $task->id]);
    }

    public function test_delete_non_existing_task_returns_not_found()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->deleteJson('/api/v1/tasks/999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'No tasks found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
