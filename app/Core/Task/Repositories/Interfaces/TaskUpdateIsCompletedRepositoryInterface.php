<?php

namespace App\Core\Task\Repositories\Interfaces;

use App\Core\Task\DTO\TaskUpdateIsCompletedDTO;
use App\Models\Task;

interface TaskUpdateIsCompletedRepositoryInterface
{
    public function updateIsCompletedRepo(TaskUpdateIsCompletedDTO $dto): ?Task;
}
