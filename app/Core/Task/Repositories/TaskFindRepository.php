<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskFindRepositoryInterface;
use App\Models\Task;

class TaskFindRepository implements TaskFindRepositoryInterface
{
    public function findRepo(int $id): ?Task
    {
        return Task::find($id);
    }
}
