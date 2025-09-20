<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\DTO\TaskUpdateDTO;
use App\Core\Task\Repositories\Interfaces\TaskUpdateRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskUpdateRepository implements TaskUpdateRepositoryInterface
{
    public function updateRepo(TaskUpdateDTO $dto): ?Task
    {
        $task = Task::find($dto->id);

        Gate::authorize('update', $task);

        if ($task) {
            $task->update($dto->toArray());

            return $task;
        }

        return null;
    }
}
