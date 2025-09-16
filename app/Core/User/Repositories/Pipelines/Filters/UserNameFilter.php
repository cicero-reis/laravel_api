<?php

namespace App\Core\User\Repositories\Pipelines\Filters;

use Closure;

class UserNameFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        return $next($query);
    }
}

