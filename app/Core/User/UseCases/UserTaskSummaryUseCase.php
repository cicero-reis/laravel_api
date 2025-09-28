<?php

namespace App\Core\User\UseCases;

use App\Core\Task\Services\Delivery\DeliveryStatusService;
use App\Core\User\Repositories\Interfaces\UserTaskSummaryRepositoryInterface;
use App\Core\User\UseCases\Interfaces\UserTaskSummaryUseCaseInterface;
use Illuminate\Support\Collection;

class UserTaskSummaryUseCase implements UserTaskSummaryUseCaseInterface
{
    public UserTaskSummaryRepositoryInterface $repo;

    public DeliveryStatusService $deliveryService;

    public function __construct(UserTaskSummaryRepositoryInterface $repo)
    {
        $this->repo = $repo;
        $this->deliveryService = resolve(DeliveryStatusService::class);
    }

    public function execute(int $id): Collection
    {
        $user = $this->repo->taskSummaryRepo($id);
        $result = collect();

        if ($user) {
            $result = $this->taskSummaryCollection($user);

            return $result;
        }

        return $result;
    }

    public function taskSummaryCollection($user)
    {
        return $user->map(function ($user) {
            $total = $user->tasks->count();
            $onTime = 0;
            $late = 0;
            $pending = 0;

            foreach ($user->tasks as $task) {

                $result = $this->deliveryService->getStatus($task);

                if ($task->is_completed == 1) {

                    if ($result['value'] == 'Within deadline' || $result['value'] == 'Due today') {
                        $onTime++;
                    }

                    if ($result['value'] == 'Overdue') {
                        $late++;
                    }

                } else {
                    $pending++;
                }
            }

            return [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'task_summary' => [
                    'total' => $total,
                    'on_time' => $onTime,
                    'late' => $late,
                    'pending' => $pending,
                    'percent_on_time' => $total > 0 ? round((($onTime + $late) / $total) * 100, 2) : 0,
                ],
            ];
        });
    }
}
