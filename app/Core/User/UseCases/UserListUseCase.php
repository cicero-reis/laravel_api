<?php

namespace App\Core\User\UseCases;

use App\Core\User\Repositories\Interfaces\UserListRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserListUseCaseInterface;

class UserListUseCase implements UserListUseCaseInterface
{
    public UserListRepositoryInterface $repo;

    public function __construct(UserListRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(array $filters, $paginate = true): mixed
    {
        return $this->repo->listRepo($filters, $paginate);
    }
}
