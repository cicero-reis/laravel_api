<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\ListTasksRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\ListTasksUseCaseInterface;

class ListTasksUseCase implements ListTasksUseCaseInterface
{
    public function __construct(
        private ListTasksRepositoryInterface $listTasksRepository
    ) {
    }

    public function execute(array $filters, $paginate = true): mixed
    {
        return $this->listTasksRepository->listRepo($filters, $paginate);
    }
}

