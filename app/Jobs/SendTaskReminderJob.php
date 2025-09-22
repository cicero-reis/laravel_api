<?php

namespace App\Jobs;

use App\Infrastructure\Firebase\FirebaseMessaging;
use App\Models\Task;
use App\Core\Task\Services\Delivery\DeliveryStatusService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendTaskReminderJob
{
    /**
     * Execute the job.
     */
    public function handle(FirebaseMessaging $fcm, DeliveryStatusService $deliveryStatus): void
    {
        $today = Carbon::today();

        Task::with('user')
            ->whereDate('due_date', $today)
            ->where('is_completed', 0)
            ->chunk(500, function ($tasks) use ($fcm, $deliveryStatus) {
                foreach ($tasks as $task) {
                    
                    echo $task->id . PHP_EOL;

                    if (!$task->user || !$task->user->fcm_token) {
                        continue;
                    }
                    
                    $status = $deliveryStatus->getStatus($task);

                    $fcm->sendToToken(
                        $task->user->fcm_token,
                        'Task Reminder',
                        "The task \"{$task->name}\" is due today!",
                        [
                            'task_id' => (string) $task->id,
                            'status'  => $status['value'],
                            'color'   => $status['color'],
                        ]
                    );
                }
            });
    }
}

