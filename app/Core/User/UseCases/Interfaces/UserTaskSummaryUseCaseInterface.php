<?php

namespace App\Core\User\UseCases\Interfaces;

use Illuminate\Support\Collection;

interface UserTaskSummaryUseCaseInterface
{
    public function execute(int $id): Collection;
}
