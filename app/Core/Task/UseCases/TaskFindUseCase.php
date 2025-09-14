<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\TaskFindRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskFindUseCaseInterface;
use App\Models\Task;

class TaskFindUseCase implements TaskFindUseCaseInterface
{
    public function __construct(
        private TaskFindRepositoryInterface $repo
    ) {}

    public function execute(int $id): ?Task
    {
        return $this->repo->findRepo($id);
    }
}
