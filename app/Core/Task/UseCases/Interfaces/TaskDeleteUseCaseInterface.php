<?php

namespace App\Core\Task\UseCases\Interfaces;

use App\Models\Task;

interface TaskDeleteUseCaseInterface
{
    public function execute(int $id): bool;
}
