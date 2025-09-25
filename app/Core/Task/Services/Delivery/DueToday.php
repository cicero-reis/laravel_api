<?php

namespace App\Core\Task\Services\Delivery;

use App\Core\Task\Services\Delivery\Interfaces\DeliveryStatusStrategyInterface;
use App\Core\Task\Services\Enums\DeliveryStatus;
use Carbon\Carbon;

class DueToday implements DeliveryStatusStrategyInterface
{
    public function applies($task): bool
    {
        return Carbon::now()->startOfDay()->isSameDay(Carbon::parse($task->due_date));
    }

    public function getStatus(): DeliveryStatus
    {
        return DeliveryStatus::DUE_TODAY;
    }
}
