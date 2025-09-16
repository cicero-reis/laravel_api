<?php

namespace App\Core\User\Repositories\Interfaces;

use App\Core\User\DTO\UserCreateDTO;
use App\Models\User;

interface UserCreateRepositoryInterface
{
    public function createRepo(UserCreateDTO $data): ?User;
}