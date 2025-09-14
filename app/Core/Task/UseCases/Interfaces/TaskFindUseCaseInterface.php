<?php

namespace App\Core\Task\UseCases\Interfaces;

use App\Models\Task;

interface TaskFindUseCaseInterface
{
    public function execute(int $id): ?Task;
}
