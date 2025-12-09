<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\TaskETLRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskETLUseCaseInterface;

class TaskETLUseCase implements TaskETLUseCaseInterface
{
    public function __construct(
        private TaskETLRepositoryInterface $repo
    ) {}

    public function execute(): mixed
    {
        return $this->repo->listTask();
    }
}
