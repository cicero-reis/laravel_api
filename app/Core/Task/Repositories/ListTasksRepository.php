<?php

namespace App\Core\Task\Repositories;

use App\Core\Task\Repositories\Interfaces\ListTasksRepositoryInterface;
use App\Models\Task;

class ListTasksRepository implements ListTasksRepositoryInterface
{
    public function listRepo(array $filters, $paginate = true): mixed
    {
        $query = Task::query();

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if (isset($filters['is_completed'])) {
            $query->where('is_completed', $filters['is_completed']);
        }

        if (isset($filters['created_at'])) {
            $query->whereDate('created_at', '>=', $filters['created_at']);
        }

        if (! $paginate) {
            return $query->get();
        }

        return $query->paginate(5);
    }
}
