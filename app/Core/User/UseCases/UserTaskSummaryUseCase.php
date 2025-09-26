<?php

namespace App\Core\User\UseCases;

use App\Core\User\Repositories\Interfaces\UserTaskSummaryRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserTaskSummaryUseCaseInterface;
use Illuminate\Support\Collection;

class UserTaskSummaryUseCase implements UserTaskSummaryUseCaseInterface
{
    public UserTaskSummaryRepositoryInterface $repo;

    public function __construct(UserTaskSummaryRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function execute(int $id): Collection
    {
        $user = $this->repo->taskSummaryRepo($id);
        $result = collect();

        if ($user) {
            $result = taskSummaryCollection($user);

            return $result;
        }

        return $result;
    }
}
