<?php

namespace App\Core\Task\Repositories\Pipelines\Filters;

use Closure;

class TaskIsCompletedFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('is_completed')) {
            $query->where('is_completed', request('is_completed'));
        }

        return $next($query);
    }
}
