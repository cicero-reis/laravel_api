<?php

namespace App\Core\User\UseCases\Interfaces;

use App\Core\User\DTO\UserCreateDTO;
use App\Models\User;

interface UserCreateUseCaseInterface
{
    public function execute(UserCreateDTO $userCreateDTO): ?User;
}