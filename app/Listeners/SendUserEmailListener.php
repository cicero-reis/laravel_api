<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendUserEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {}

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): void
    {
        Mail::to($event->user->email)->queue(new UserMail($event->user));
    }
}
