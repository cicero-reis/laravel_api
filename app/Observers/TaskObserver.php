<?php

namespace App\Observers;

use App\Events\TaskRegisteredEvent;
use App\Models\Task;
use Carbon\Carbon;

class TaskObserver
{
    public function created(Task $task): void
    {
        TaskRegisteredEvent::dispatch($task);
    }

    public function creating(Task $task): void
    {
        $task->due_date = Carbon::now()->addDays(intval($task->priority));
    }

    public function updating(Task $task): void
    {
        if ($task->isDirty('priority')) {
            $task->due_date = Carbon::now()->addDays(intval($task->priority));
        }
    }
}
