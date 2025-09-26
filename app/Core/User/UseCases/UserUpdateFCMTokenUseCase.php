<?php

namespace App\Core\User\UseCases;

use App\Core\User\DTO\UserUpdateFCMTokenDTO;
use App\Core\User\Repositories\Interfaces\UserUpdateFCMTokenRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserUpdateFCMTokenUseCaseInterface;

class UserUpdateFCMTokenUseCase implements UserUpdateFCMTokenUseCaseInterface
{
    public UserUpdateFCMTokenRepositoryInterface $repo;

    public function __construct(UserUpdateFCMTokenRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(UserUpdateFCMTokenDTO $dto, int $id): bool
    {
        return $this->repo->updateFCMTokenRepo($dto, $id);
    }
}
