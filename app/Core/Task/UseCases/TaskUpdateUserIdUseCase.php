<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\DTO\TaskUpdateUserIdDTO;
use App\Core\Task\Repositories\Interfaces\TaskUpdateUserIdRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskUpdateUserIdUseCaseInterface;
use App\Models\Task;

class TaskUpdateUserIdUseCase implements TaskUpdateUserIdUseCaseInterface
{
    public function __construct(
        private TaskUpdateUserIdRepositoryInterface $repo
    ) {}

    public function execute(TaskUpdateUserIdDTO $dto): ?Task
    {
        return $this->repo->updateIsCompletedRepo($dto);
    }
}
