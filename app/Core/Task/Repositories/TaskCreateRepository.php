<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\DTO\TaskCreateDTO;
use App\Core\Task\Repositories\Interfaces\TaskCreateRepositoryInterface;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskCreateRepository implements TaskCreateRepositoryInterface
{
    public function createRepo(TaskCreateDTO $dto): ?Task
    {
        Gate::authorize('created');
        
        return Task::create($dto->toArray());
    }
}
