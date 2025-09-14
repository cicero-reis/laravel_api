<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\DTO\TaskCreateDTO;
use App\Core\Task\Repositories\Interfaces\TaskCreateRepositoryInterface;
use App\Models\Task;

class TaskCreateRepository implements TaskCreateRepositoryInterface
{
    public function createRepo(TaskCreateDTO $dto): ?Task
    {
        return Task::create($dto->toArray());
    }
}
