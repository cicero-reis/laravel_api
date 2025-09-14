<?php

namespace App\Core\Task\Repositories\Interfaces;

use App\Models\Task;

interface TaskFindRepositoryInterface
{
    public function findRepo(int $id): ?Task;
}
