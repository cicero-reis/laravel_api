<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskDeleteRepositoryInterface;
use App\Models\Task;

class TaskDeleteRepository implements TaskDeleteRepositoryInterface
{
    public function deleteRepo(int $id): bool
    {
        $task = Task::find($id);
        if (!$task) {
            return false;
        }
        return (bool) $task->delete();
    }
}
