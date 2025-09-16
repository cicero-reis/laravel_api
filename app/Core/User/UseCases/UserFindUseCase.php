<?php

namespace App\Core\User\UseCases;

use App\Core\User\UseCases\Interfaces\UserFindUseCaseInterface;
use App\Core\User\Repositories\Interfaces\UserFindRepositoryInterface;
use App\Models\User;

class UserFindUseCase implements UserFindUseCaseInterface
{
    public UserFindRepositoryInterface $repo;

    public function __construct(UserFindRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(int $id): ?User
    {
        return $this->repo->findRepo($id);
    }
}
