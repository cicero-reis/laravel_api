<?php

namespace App\Core\Task\UseCases\Interfaces;

use App\Core\Task\DTO\TaskUpdateUserIdDTO;
use App\Models\Task;

interface TaskUpdateUserIdUseCaseInterface
{
    public function execute(TaskUpdateUserIdDTO $dto): ?Task;
}
