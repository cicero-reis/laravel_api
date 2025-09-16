<?php

namespace App\Core\User\UseCases;

use App\Core\User\DTO\UserCreateDTO;
use App\Core\User\Repositories\Interfaces\UserCreateRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserCreateUseCaseInterface;
use App\Models\User;

class UserCreateUseCase implements UserCreateUseCaseInterface
{
    public UserCreateRepositoryInterface $repo;

    public function __construct(UserCreateRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }   

    public function execute(UserCreateDTO $dto): ?User
    {
        return $this->repo->createRepo($dto);    
    }
}