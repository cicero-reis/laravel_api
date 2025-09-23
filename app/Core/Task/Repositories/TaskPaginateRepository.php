<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\TaskPaginatetRepositoryInterface;
use App\Core\Task\Repositories\Pipelines\Filters\TaskCreatedAtFilter;
use App\Core\Task\Repositories\Pipelines\Filters\TaskIsCompletedFilter;
use App\Core\Task\Repositories\Pipelines\Filters\TaskNameFilter;
use App\Models\Task;
use Illuminate\Pipeline\Pipeline;

class TaskPaginateRepository implements TaskPaginatetRepositoryInterface
{
    public function listRepo(array $filters, int $paginate = 100): mixed
    {
        $query = app(Pipeline::class)
            ->send(Task::query())
            ->through([
                TaskNameFilter::class,
                TaskIsCompletedFilter::class,
                TaskCreatedAtFilter::class,
            ])
            ->thenReturn();

        return $query->paginate($paginate);
    }
}
