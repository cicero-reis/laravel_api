<?php

namespace App\Core\User\UseCases\Interfaces;

interface UserListUseCaseInterface
{
    public function execute(array $filters, $paginate = true): mixed;
}