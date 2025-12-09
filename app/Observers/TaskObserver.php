<?php

namespace App\Observers;

use App\Events\TaskRegisteredEvent;
use App\Models\Task;
use App\Models\TaskLog;
use Carbon\Carbon;

class TaskObserver
{
    public function created(Task $task): void
    {
        // TaskLog::create([
        //     'task_id' => $task->id,
        //     'user_id' => request()->user()->id,
        //     'action' => 'created',
        //     'changes' => $task->getAttributes(),
        // ]);

        // TaskRegisteredEvent::dispatch($task);
    }

    public function creating(Task $task): void
    {
        $task->due_date = Carbon::now()->addDays(intval($task->priority));
    }

    public function updated(Task $task): void
    {
        TaskLog::create([
            'task_id' => $task->id,
            'user_id' => request()->user()->id,
            'action' => 'updated',
            'changes' => $task->getChanges(), // só campos alterados
        ]);
    }

    public function updating(Task $task): void
    {
        if ($task->isDirty('priority')) {
            $task->due_date = Carbon::now()->addDays(intval($task->priority));
        }
    }

    public function deleted(Task $task): void
    {
        TaskLog::create([
            'task_id' => $task->id,
            'user_id' => request()->user()->id,
            'action' => 'deleted',
            'changes' => $task->getAttributes(),
        ]);
    }
}
