<?php

namespace App\Core\Task\Repositories\Interfaces;

use App\Core\Task\DTO\TaskUpdateUserIdDTO;
use App\Models\Task;

interface TaskUpdateUserIdRepositoryInterface
{
    public function updateIsCompletedRepo(TaskUpdateUserIdDTO $dto): ?Task;
}
