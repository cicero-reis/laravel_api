<?php

namespace App\Core\User\Repositories\Interfaces;

interface UserProfileRepositoryInterface
{
    public function updateProfileImagePath(int $userId, string $path): bool;
}
