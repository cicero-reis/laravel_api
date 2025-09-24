<?php

namespace App\Core\User\Repositories;

use App\Core\User\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Models\User;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function updateProfileImagePath(int $userId, string $path): bool
    {
        $user = User::find($userId);
        if (! $user) {
            return false;
        }
        $user->profile = $path;

        return $user->save();
    }
}
