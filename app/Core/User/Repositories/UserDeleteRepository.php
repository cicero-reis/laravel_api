<?php

namespace App\Core\User\Repositories;

use App\Models\User;
use App\Core\User\Repositories\Interfaces\UserDeleteRepositoryInterface;

class UserDeleteRepository implements UserDeleteRepositoryInterface
{
    public function deleteRepo(int $id): bool
    {
        $user = User::find($id);
        if ($user) {
            return (bool) $user->delete();
        }
        return false;
    }
}