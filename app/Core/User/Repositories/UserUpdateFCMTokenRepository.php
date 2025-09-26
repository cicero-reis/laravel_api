<?php

namespace App\Core\User\Repositories;

use App\Core\User\DTO\UserUpdateFCMTokenDTO;
use App\Core\User\Repositories\Interfaces\UserUpdateFCMTokenRepositoryInterface;
use App\Models\User;

class UserUpdateFCMTokenRepository implements UserUpdateFCMTokenRepositoryInterface
{
    public function updateFCMTokenRepo(UserUpdateFCMTokenDTO $dto): bool
    {
        $user = User::find($dto->id);

        if (! $user) {
            return false;
        }

        $user->fcm_token = $dto->fcm_token;

        return $user->save();
    }
}
