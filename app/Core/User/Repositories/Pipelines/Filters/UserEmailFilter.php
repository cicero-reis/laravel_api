<?php

namespace App\Core\User\Repositories\Pipelines\Filters;

use Closure;

class UserEmailFilter
{
    public function handle($query, Closure $next)
    {
        if (request()->filled('email')) {
            $query->where('email', request('email'));
        }

        return $next($query);
    }
}