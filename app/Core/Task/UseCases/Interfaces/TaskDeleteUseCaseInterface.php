<?php

namespace App\Core\Task\UseCases\Interfaces;

interface TaskDeleteUseCaseInterface
{
    public function execute(int $id): bool;
}
