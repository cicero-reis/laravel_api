<?php

namespace App\Core\User\UseCases\Interfaces;

use App\Models\User;

interface UserFindUseCaseInterface
{
    public function execute(int $id): ?User;
}
