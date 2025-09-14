<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\DTO\TaskUpdateDTO;
use App\Core\Task\Repositories\Interfaces\TaskUpdateRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskUpdateUseCaseInterface;
use App\Models\Task;

class TaskUpdateUseCase implements TaskUpdateUseCaseInterface
{
    public function __construct(
        private TaskUpdateRepositoryInterface $repo
    ) {}

    public function execute(TaskUpdateDTO $dto): ?Task
    {
        return $this->repo->updateRepo($dto);
    }
}
