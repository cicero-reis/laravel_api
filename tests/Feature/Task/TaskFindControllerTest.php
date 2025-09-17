<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;

class TaskFindControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        Gate::shouldReceive('authorize')->andReturn(true);
    }

    public function test_show_returns_task_by_id()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $response = $this
                        ->actingAs($user)
                        ->getJson('/api/v1/tasks/'.$task->id);

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
        $user = User::factory()->create();
        $response = $this
                        ->actingAs($user)
                        ->getJson('/api/v1/tasks/999');

        $response->assertStatus(404);

        $response->assertJson([
            'message' => 'No tasks found',
            'details' => 'error',
            'code' => 404,
        ]);
    }
}
