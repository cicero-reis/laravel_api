<?php

namespace App\Core\User\Repositories;

use App\Core\User\Repositories\Interfaces\UserFindRepositoryInterface;
use App\Models\User;
use Illuminate\Pipeline\Pipeline;
use App\Core\User\Repositories\Pipelines\Filters\UserCreatedAtFilter;
use App\Core\User\Repositories\Pipelines\Filters\UserEmailFilter;
use App\Core\User\Repositories\Pipelines\Filters\UserNameFilter;

class UserFindRepository implements UserFindRepositoryInterface
{
    public function findRepo(int $id): ?User
    {
        return User::find($id);
    }
}
