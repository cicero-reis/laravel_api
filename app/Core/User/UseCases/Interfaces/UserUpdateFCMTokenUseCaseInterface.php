<?php

namespace App\Core\User\UseCases\Interfaces;

use App\Core\User\DTO\UserUpdateFCMTokenDTO;

interface UserUpdateFCMTokenUseCaseInterface
{
    public function execute(UserUpdateFCMTokenDTO $dto, int $id): bool;
}
