<?php

namespace App\Observers;

use App\Events\UserRegisteredEvent;
use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        // UserRegisteredEvent::dispatch($user);
    }
}
