<?php

namespace App\Core\User\Repositories;

use App\Core\User\DTO\UserCreateDTO;
use App\Core\User\Repositories\Interfaces\UserCreateRepositoryInterface;
use App\Models\User;

class UserCreateRepository implements UserCreateRepositoryInterface
{
    public function createRepo(UserCreateDTO $dto): User
    {
        return User::create($dto->toArray());
    }
}
