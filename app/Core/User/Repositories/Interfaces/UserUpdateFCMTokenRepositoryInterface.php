<?php

namespace App\Core\User\Repositories\Interfaces;

use App\Core\User\DTO\UserUpdateFCMTokenDTO;

interface UserUpdateFCMTokenRepositoryInterface
{
    public function updateFCMTokenRepo(UserUpdateFCMTokenDTO $dto): bool;
}
