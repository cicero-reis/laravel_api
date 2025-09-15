<?php

namespace App\Listeners;

use App\Events\TaskRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogTaskListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskRegisteredEvent $event): void
    {
        Log::channel('cloudwatch')->info('Task criada com sucesso', [
            'task_id' => $event->task->id, 
            'task_name' => $event->task->name
        ]);
    }
}
