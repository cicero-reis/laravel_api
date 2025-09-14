<?php

namespace App\Core\Task\Repositories\Interfaces;

interface TaskDeleteRepositoryInterface
{
    public function deleteRepo(int $id): bool;
}
