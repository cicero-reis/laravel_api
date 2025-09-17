<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskDeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();
    }

    public function test_delete_existing_task_returns_no_content()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/v1/tasks/{$task->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_delete_non_existing_task_returns_not_found()
    {
        // Act: call the endpoint buscando uma tarefa inexistente
        $response = $this->deleteJson('/api/v1/tasks/999');

        // Assert: check response
        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'No tasks found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
