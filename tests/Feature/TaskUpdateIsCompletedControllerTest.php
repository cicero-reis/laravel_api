<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskUpdateIsCompletedControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_task_is_completed_successfully()
    {
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
            'is_completed' => 1
        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
            'is_completed',
            'created_at'
        ]);
    }

    public function test_create_task_validation_error()
    {
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
            'is_completed' => 10
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['is_completed']);
    }
}
