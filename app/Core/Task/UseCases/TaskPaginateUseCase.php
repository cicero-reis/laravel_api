<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\TaskPaginatetRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskPaginateUseCaseInterface;

class TaskPaginateUseCase implements TaskPaginateUseCaseInterface
{
    public function __construct(
        private TaskPaginatetRepositoryInterface $repo
    ) {}

    public function execute(array $filters, int $paginate = 100): mixed
    {
        return $this->repo->listRepo($filters, $paginate);
    }
}
