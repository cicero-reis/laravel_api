<?php

namespace App\Core\User\Repositories;

use App\Core\User\Repositories\Interfaces\UserListRepositoryInterface;
use App\Core\User\Repositories\Pipelines\Filters\UserCreatedAtFilter;
use App\Core\User\Repositories\Pipelines\Filters\UserEmailFilter;
use App\Core\User\Repositories\Pipelines\Filters\UserNameFilter;
use App\Models\User;
use Illuminate\Pipeline\Pipeline;

class UserListRepository implements UserListRepositoryInterface
{
    public function listRepo(array $filters, $paginate = true): mixed
    {
        $query = app(Pipeline::class)
            ->send(User::query())
            ->through([
                UserNameFilter::class,
                UserEmailFilter::class,
                UserCreatedAtFilter::class,
            ])
            ->thenReturn();

        if ($paginate) {
            return $query->paginate(5);
        }

        return $query->get();
    }
}
