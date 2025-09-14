<?php

namespace App\Core\Task\UseCases\Interfaces;

use App\Core\Task\DTO\TaskCreateDTO;
use App\Models\Task;

interface TaskCreateUseCaseInterface
{
    public function execute(TaskCreateDTO $dto): ?Task;
}
