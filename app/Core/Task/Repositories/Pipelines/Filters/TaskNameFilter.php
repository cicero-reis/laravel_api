<?php

namespace App\Core\Task\Repositories\Pipelines\Filters;

use Closure;

class TaskNameFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('name')) {
            $query->where('name', 'like', '%'.request('name').'%');
        }

        return $next($query);
    }
}
