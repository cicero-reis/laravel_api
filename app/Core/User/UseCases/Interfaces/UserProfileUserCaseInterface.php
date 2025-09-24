<?php

namespace App\Core\User\UseCases\Interfaces;

interface UserProfileUserCaseInterface
{
    public function execute(int $userId, string $path): bool;
}
