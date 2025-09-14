<?php

namespace App\Core\Task\Repositories\Interfaces;

use App\Core\Task\DTO\TaskCreateDTO;
use App\Models\Task;

interface TaskCreateRepositoryInterface
{
    public function createRepo(TaskCreateDTO $dto): ?Task;
}
