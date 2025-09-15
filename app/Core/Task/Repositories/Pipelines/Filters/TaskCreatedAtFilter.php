<?php

namespace App\Core\Task\Repositories\Pipelines\Filters;

use Closure;
use Carbon\Carbon;

class TaskCreatedAtFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('created_at')) {
            $date = Carbon::createFromFormat('d/m/Y', request('created_at'))->format('Y-m-d');
            $query->whereDate('created_at', '>=', $date);
        }

        return $next($query);
    }
}
