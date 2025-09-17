<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskFindRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskFindRepository implements TaskFindRepositoryInterface
{
    public function findRepo(int $id): ?Task
    {
        $task = Task::find($id);

        Gate::authorize('view', $task);

        return $task;
    }
}
