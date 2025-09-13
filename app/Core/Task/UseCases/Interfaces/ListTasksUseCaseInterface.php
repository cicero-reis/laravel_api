<?php

namespace App\Core\Task\UseCases\Interfaces;

interface ListTasksUseCaseInterface
{
    public function execute(array $filters, $paginate = true): mixed;
}