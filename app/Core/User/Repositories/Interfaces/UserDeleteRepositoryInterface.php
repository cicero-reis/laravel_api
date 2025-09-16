<?php

namespace App\Core\User\Repositories\Interfaces;

interface UserDeleteRepositoryInterface
{
    public function deleteRepo(int $id): bool;
}
