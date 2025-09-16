<?php

namespace App\Core\User\Repositories\Interfaces;

interface UserListRepositoryInterface
{
    public function listRepo(array $filters, $paginate = true): mixed;
}