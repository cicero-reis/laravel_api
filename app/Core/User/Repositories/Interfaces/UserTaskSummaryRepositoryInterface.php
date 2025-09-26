<?php

namespace App\Core\User\Repositories\Interfaces;

use App\Models\User;

interface UserTaskSummaryRepositoryInterface
{
    public function taskSummaryRepo(int $id);
}