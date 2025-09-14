<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskUpdateRepositoryInterface;
use App\Models\Task;
use App\Core\Task\DTO\TaskUpdateDTO;

class TaskUpdateRepository implements TaskUpdateRepositoryInterface
{
    public function updateRepo(TaskUpdateDTO $dto): ?Task
    {
        $task = Task::find($dto->id);
        if ($task) {
            $task->update($dto->toArray());
            return $task;
        }
        return null;        
    }    
}
