<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskUpdateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_task_success()
    {
        $task = Task::factory()->create(['name' => 'Old Name']);

        $payload = ['name' => 'New Name'];

        $response = $this->putJson("/api/v1/tasks/{$task->id}", $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'New Name']);
    }

    public function test_update_task_not_found()
    {
        $payload = ['name' => 'New Name'];

        $response = $this->putJson('/api/v1/tasks/9999', $payload);

        $response->assertStatus(404)
                 ->assertJsonFragment([
                    "message" => "No tasks found",
                    "details" => "error",
                    "code" => 404
                ]);
    }

    public function test_update_task_validation_error()
    {
        $task = Task::factory()->create();

        $payload = ['name' => ''];

        //$response = $this->actingAs($user)->putJson("/api/v1/tasks/{$task->id}", $payload);
        $response = $this->putJson("/api/v1/tasks/{$task->id}", $payload);

        $response->assertStatus(422);
    }
}
