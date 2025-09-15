<?php

namespace App\Core\Task\Repositories;

use App\Models\Task;
use App\Core\Task\Repositories\Interfaces\TaskListRepositoryInterface;
use Illuminate\Pipeline\Pipeline;
use App\Core\Task\Repositories\Pipelines\Filters\TaskNameFilter;
use App\Core\Task\Repositories\Pipelines\Filters\TaskIsCompletedFilter;
use App\Core\Task\Repositories\Pipelines\Filters\TaskCreatedAtFilter;

class TaskListRepository implements TaskListRepositoryInterface
{
    public function listRepo(array $filters, $paginate = true): mixed
    {
        $query = app(Pipeline::class)
            ->send(Task::query())
            ->through([
                TaskNameFilter::class,
                TaskIsCompletedFilter::class,
                TaskCreatedAtFilter::class,
            ])
            ->thenReturn();

        if (! $paginate) {
            return $query->get();
        }

        return $query->paginate(5);
    }
}
