<?php

namespace Tests\Feature\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_tasks_list()
    {
        // Arrange: create some tasks
        Task::factory()->count(3)->create();

        // Act: call the endpoint
        $response = $this->getJson('/api/v1/tasks');

        // Assert: check response
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'meta',
        ]);
        $this->assertCount(3, $response->json('data'));
    }

    public function test_index_returns_404_when_no_tasks_found()
    {
        // Act: call the endpoint with no tasks
        $response = $this->getJson('/api/v1/tasks');

        // Assert: check response
        $response->assertStatus(404);
        $response->assertJson([
            'error' => 'No tasks found',
        ]);
    }
}
