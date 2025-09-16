<?php

namespace App\Core\User\Repositories\Interfaces;

use App\Models\User;
use App\Core\User\DTO\UserUpdateDTO;

interface UserUpdateRepositoryInterface
{
    public function updateRepo(UserUpdateDTO $dto): ?User;
}
