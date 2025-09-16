<?php

namespace App\Core\User\UseCases;

use App\Core\User\Repositories\Interfaces\UserDeleteRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserDeleteUseCaseInterface;

class UserDeleteUseCase implements UserDeleteUseCaseInterface
{
    public UserDeleteRepositoryInterface $repo;

    public function __construct(UserDeleteRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(int $id): bool
    {
        return $this->repo->deleteRepo($id);
    }
}
