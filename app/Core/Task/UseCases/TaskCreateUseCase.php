<?php

namespace App\Core\Task\UseCases;

use App\Core\Task\Repositories\Interfaces\TaskCreateRepositoryInterface;
use App\Core\Task\UseCases\Interfaces\TaskCreateUseCaseInterface;
use App\Core\Task\DTO\TaskCreateDTO;
use App\Models\Task;

class TaskCreateUseCase implements TaskCreateUseCaseInterface
{
    public function __construct(
        private TaskCreateRepositoryInterface $repo
    ) {}

    public function execute(TaskCreateDTO $dto): ?Task
    {
        return $this->repo->createRepo($dto);
    }
}
