<?php

namespace App\Core\User\Repositories\Interfaces;

use App\Core\User\DTO\UserUpdateDTO;
use App\Models\User;

interface UserUpdateRepositoryInterface
{
    public function updateRepo(UserUpdateDTO $dto): ?User;
}
