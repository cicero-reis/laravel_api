<?php

namespace App\Core\Task\UseCases\Interfaces;

use App\Core\Task\DTO\TaskUpdateDTO;
use App\Models\Task;

interface TaskUpdateUseCaseInterface
{
    public function execute(TaskUpdateDTO $dto): ?Task;
}
