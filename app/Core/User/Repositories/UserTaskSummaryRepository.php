<?php

namespace App\Core\User\Repositories;

use App\Core\User\Repositories\Interfaces\UserTaskSummaryRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class UserTaskSummaryRepository implements UserTaskSummaryRepositoryInterface
{
    public function taskSummaryRepo(int $id): Collection
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return User::where('id', $id)
                ->with(['tasks' => function ($query) use ($startOfMonth, $endOfMonth) {
                    $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                }])
                ->get();
    }
}
