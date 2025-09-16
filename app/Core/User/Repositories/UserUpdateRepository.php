<?php

namespace App\Core\User\Repositories;

use App\Models\User;
use App\Core\User\DTO\UserUpdateDTO;
use \App\Core\User\Repositories\Interfaces\UserUpdateRepositoryInterface;

class UserUpdateRepository implements UserUpdateRepositoryInterface
{
    public function updateRepo(UserUpdateDTO $dto): ?User
    {
        $user = User::find($dto->id);
        if ($user) {
            $user->update($dto->toArray());
            return $user;
        }
        return null;
    }
}

