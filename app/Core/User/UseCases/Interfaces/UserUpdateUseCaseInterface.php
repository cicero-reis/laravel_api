<?php

namespace App\Core\User\UseCases\Interfaces;

use App\Core\User\DTO\UserUpdateDTO;
use App\Models\User;

interface UserUpdateUseCaseInterface
{
    public function execute(UserUpdateDTO $userUpdateDTO, int $id): ?User;
}
