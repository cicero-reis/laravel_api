<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskListRepositoryInterface;
use App\Core\Task\Repositories\Pipelines\Filters\TaskCreatedAtFilter;
use App\Core\Task\Repositories\Pipelines\Filters\TaskIsCompletedFilter;
use App\Core\Task\Repositories\Pipelines\Filters\TaskNameFilter;
use App\Models\Task;
use Illuminate\Pipeline\Pipeline;

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

        return $query->paginate(100);
    }
}
