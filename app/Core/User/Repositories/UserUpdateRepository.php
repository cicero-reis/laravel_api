<?php

namespace App\Core\User\Repositories;

use App\Core\User\DTO\UserUpdateDTO;
use App\Core\User\Repositories\Interfaces\UserUpdateRepositoryInterface;
use App\Models\User;

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
