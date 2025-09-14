<?php

namespace App\Core\Task\Repositories\Interfaces;

use App\Core\Task\DTO\TaskUpdateDTO;
use App\Models\Task;

interface TaskUpdateRepositoryInterface
{
    public function updateRepo(TaskUpdateDTO $dto): ?Task;
}
