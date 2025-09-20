<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\DTO\TaskUpdateIsCompletedDTO;
use App\Core\Task\Repositories\Interfaces\TaskUpdateIsCompletedRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskUpdateIsCompletedRepository implements TaskUpdateIsCompletedRepositoryInterface
{
    public function updateIsCompletedRepo(TaskUpdateIsCompletedDTO $dto): ?Task
    {
        $task = Task::find($dto->id);

        // Gate::authorize('update', $task);

        if (! $task) {
            return null;
        }
        $task->is_completed = $dto->is_completed;
        $task->save();

        return $task;
    }
}
