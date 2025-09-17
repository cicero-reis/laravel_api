<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;

class TaskListControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        Gate::shouldReceive('authorize')->andReturn(true);
    }

    public function test_index_returns_tasks_list()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/tasks');
        
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'meta',
        ]);
        
        $this->assertCount(3, $response->json('data'));
    }

    public function test_index_returns_404_when_no_tasks_found()
    {        
        $response = $this->getJson('/api/v1/tasks');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'No tasks found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
