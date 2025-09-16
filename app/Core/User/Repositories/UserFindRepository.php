<?php

namespace App\Core\User\Repositories;

use App\Core\User\Repositories\Interfaces\UserFindRepositoryInterface;
use App\Models\User;

class UserFindRepository implements UserFindRepositoryInterface
{
    public function findRepo(int $id): ?User
    {
        return User::find($id);
    }
}
