<?php

namespace App\Core\Task\UseCases\Interfaces;

interface TaskListUseCaseInterface
{
    public function execute(array $filters, $paginate = true): mixed;
}
