<?php

namespace App\Core\Task\Repositories\Interfaces;

interface TaskPaginatetRepositoryInterface
{
    public function listRepo(array $filters, int $paginate = 100): mixed;
}
