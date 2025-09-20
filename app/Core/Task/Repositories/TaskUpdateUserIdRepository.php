<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\DTO\TaskUpdateUserIdDTO;
use App\Core\Task\Repositories\Interfaces\TaskUpdateUserIdRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskUpdateUserIdRepository implements TaskUpdateUserIdRepositoryInterface
{
    public function updateIsCompletedRepo(TaskUpdateUserIdDTO $dto): ?Task
    {
        $task = Task::find($dto->id);

        Gate::authorize('update', $task);

        if (! $task) {
            return null;
        }

        $task->user_id = $dto->user_id;
        $task->save();

        return $task;
    }
}
