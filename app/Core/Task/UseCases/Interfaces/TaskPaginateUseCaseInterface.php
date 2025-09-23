<?php

namespace App\Core\Task\UseCases\Interfaces;

interface TaskPaginateUseCaseInterface
{
    public function execute(array $filters, int $paginate = 100): mixed;
}
