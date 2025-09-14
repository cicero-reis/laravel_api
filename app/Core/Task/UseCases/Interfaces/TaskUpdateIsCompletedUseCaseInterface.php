<?php

namespace App\Core\Task\UseCases\Interfaces;

use App\Core\Task\DTO\TaskUpdateIsCompletedDTO;
use App\Models\Task;

interface TaskUpdateIsCompletedUseCaseInterface
{
    public function execute(TaskUpdateIsCompletedDTO $dto): ?Task;
}
