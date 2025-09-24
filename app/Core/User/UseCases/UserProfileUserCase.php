<?php

namespace App\Core\User\UseCases;

use App\Core\User\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserProfileUserCaseInterface;

class UserProfileUserCase implements UserProfileUserCaseInterface
{
    private $userProfileRepository;

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    public function execute(int $userId, string $path): bool
    {
        return $this->userProfileRepository->updateProfileImagePath($userId, $path);
    }
}
