<?php

namespace App\Core\ETL\Services;

use App\Models\Task;
use Carbon\Carbon;
use App\Core\Task\Services\Enums\DeliveryStatus;

class TaskTransformService
{
    public function transform(Task $task): array
    {
        $due = Carbon::parse($task->due_date)->startOfDay();
        $today = Carbon::now()->startOfDay();

        // CALCULANDO O STATUS
        if ($due->isToday()) {
            $status = DeliveryStatus::DUE_TODAY;
        } elseif ($due->greaterThan($today)) {
            $status = DeliveryStatus::WITHIN_DEADLINE;
        } else {
            $status = DeliveryStatus::OVERDUE;
        }

        return [
            'task_id'   => $task->id,
            'user_name' => $task->user->name,
            'task_name' => $task->name,
            'priority'  => $task->priority,
            'due_date'  => $task->due_date,
            'status'    => $status->value,
            'color'     => $status->color(),
        ];
    }
}
