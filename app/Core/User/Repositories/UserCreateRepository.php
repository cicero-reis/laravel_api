<?php

namespace App\Core\User\Repositories;

use App\Models\User;
use App\Core\User\DTO\UserCreateDTO;
use App\Core\User\Repositories\Interfaces\UserCreateRepositoryInterface;

class UserCreateRepository implements UserCreateRepositoryInterface
{
    public function createRepo(UserCreateDTO $dto): User
    {
        return User::create($dto->toArray());
    }
}