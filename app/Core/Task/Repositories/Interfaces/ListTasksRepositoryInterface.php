<?php

namespace App\Core\Task\Repositories\Interfaces;

interface ListTasksRepositoryInterface
{
    public function listRepo(array $filters, $paginate = true): mixed;
}
