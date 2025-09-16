<?php

namespace App\Core\User\Repositories\Interfaces;

use App\Models\User;

interface UserFindRepositoryInterface
{
    public function findRepo(int $id): ?User;
}

