<?php

namespace App\Observers;

use App\Events\TaskRegisteredEvent;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        TaskRegisteredEvent::dispatch($task);
    }
}
