<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskFindControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();
    }

    public function test_show_returns_task_by_id()
    {
        // Arrange: create a task
        $task = Task::factory()->create();

        // Act: call the endpoint buscando pelo id
        $response = $this->getJson('/api/v1/tasks/'.$task->id);

        // Assert: check response
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'is_completed',
            'created_at',
        ]);
        $response->assertJson([
            'id' => $task->id,
            'name' => $task->name,
            'is_completed' => $task->is_completed,
            'created_at' => $task->created_at->format('d/m/Y H:i:s'),
        ]);
    }

    public function test_show_returns_404_when_no_task_found()
    {
        // Act: call the endpoint buscando uma tarefa inexistente
        $response = $this->getJson('/api/v1/tasks/999');

        // Assert: check response
        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'No tasks found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
