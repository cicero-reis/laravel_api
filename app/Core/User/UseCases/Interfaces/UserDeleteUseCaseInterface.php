<?php

namespace App\Core\User\UseCases\Interfaces;

interface UserDeleteUseCaseInterface
{
    public function execute(int $id): bool;
}
