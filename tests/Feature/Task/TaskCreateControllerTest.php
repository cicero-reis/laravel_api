<?php

namespace Tests\Feature\Task;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskCreateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $payload = [
            'name' => 'Test Task',
        ];

        $response = $this->postJson('/api/v1/tasks', $payload);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'is_completed',
            'created_at',
        ]);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
        ]);
    }

    public function test_create_task_validation_error()
    {
        $payload = [];

        $response = $this->postJson('/api/v1/tasks', $payload);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }
}
