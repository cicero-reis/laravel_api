<?php

namespace Tests\Feature\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Gate;

class TaskUpdateIsCompletedControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware();

        Gate::shouldReceive('authorize')->andReturn(true);
    }

    public function test_update_task_is_completed_successfully()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this
                        ->actingAs($user)
                        ->patchJson("/api/v1/tasks/{$task->id}", [
                            'is_completed' => 1,
                        ]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
            'is_completed',
            'created_at',
        ]);
    }

    public function test_create_task_validation_error()
    {
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
            'is_completed' => 10,
        ]);

        $response->assertStatus(422);
        
        $response->assertJsonValidationErrors(['is_completed']);
    }
}
