<?php

namespace App\Listeners;

use App\Events\TaskRegisteredEvent;
use App\Mail\TaskMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskEmailListener implements ShouldQueue
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
        Mail::to('creis@gmail.com')->queue(new TaskMail($event->task));
    }
}
