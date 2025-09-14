<?php

namespace App\Core\Task\Repositories\Interfaces;

interface TaskListRepositoryInterface
{
    public function listRepo(array $filters, $paginate = true): mixed;
}
