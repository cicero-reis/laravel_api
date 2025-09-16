<?php

namespace App\Core\User\UseCases;

use App\Core\User\DTO\UserUpdateDTO;
use App\Core\User\Repositories\Interfaces\UserUpdateRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserUpdateUseCaseInterface;
use App\Models\User;

class UserUpdateUseCase implements UserUpdateUseCaseInterface
{
    public UserUpdateRepositoryInterface $repo;

    public function __construct(UserUpdateRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(UserUpdateDTO $userUpdateDTO, int $id): ?User
    {
        return $this->repo->updateRepo($userUpdateDTO, $id);
    }
}
