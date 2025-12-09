<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskETLRepositoryInterface;
use App\Models\Task;

class TaskETLRepository implements TaskETLRepositoryInterface
{
    public function listTask(): mixed
    {
        $tasks = Task::with('user')->get();

        return $tasks;
    }
}
