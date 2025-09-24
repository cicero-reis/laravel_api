<?php

namespace App\Core\User\Repositories;

use App\Models\User;
use App\Core\User\Repositories\Interfaces\UserProfileRepositoryInterface;

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
