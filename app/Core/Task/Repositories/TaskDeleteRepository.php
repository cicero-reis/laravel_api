<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskDeleteRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskDeleteRepository implements TaskDeleteRepositoryInterface
{
    public function deleteRepo(int $id): bool
    {
        $task = Task::find($id);

        if (! $task) {
            return false;
        }

        Gate::authorize('delete', $task);

        return (bool) $task->delete();
    }
}
