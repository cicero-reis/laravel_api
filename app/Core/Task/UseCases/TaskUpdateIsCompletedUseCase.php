<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\DTO\TaskUpdateIsCompletedDTO;
use App\Core\Task\Repositories\Interfaces\TaskUpdateIsCompletedRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskUpdateIsCompletedUseCaseInterface;
use App\Models\Task;

class TaskUpdateIsCompletedUseCase implements TaskUpdateIsCompletedUseCaseInterface
{
    public function __construct(
        private TaskUpdateIsCompletedRepositoryInterface $repo
    ) {}

    public function execute(TaskUpdateIsCompletedDTO $dto): ?Task
    {
        return $this->repo->updateIsCompletedRepo($dto);
    }
}
