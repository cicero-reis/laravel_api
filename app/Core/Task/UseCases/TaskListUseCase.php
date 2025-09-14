<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\TaskListRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskListUseCaseInterface;

class TaskListUseCase implements TaskListUseCaseInterface
{
    public function __construct(
        private TaskListRepositoryInterface $repo
    ) {}

    public function execute(array $filters, $paginate = true): mixed
    {
        return $this->repo->listRepo($filters, $paginate);
    }
}
