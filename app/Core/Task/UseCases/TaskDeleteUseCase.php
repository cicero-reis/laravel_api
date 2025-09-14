<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\TaskDeleteRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskDeleteUseCaseInterface;

class TaskDeleteUseCase implements TaskDeleteUseCaseInterface
{
    public function __construct(
        private TaskDeleteRepositoryInterface $repo
    ) {}

    public function execute(int $id): bool
    {
        return $this->repo->deleteRepo($id);
    }
}
