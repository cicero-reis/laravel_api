<?php

namespace App\Core\Task\Services\Delivery;

use App\Core\Task\Services\Delivery\Interfaces\DeliveryStatusStrategyInterface;
use App\Core\Task\Services\Enums\DeliveryStatus;

class Overdue implements DeliveryStatusStrategyInterface
{
    public function applies($task): bool
    {
        return now()->startOfDay()->gt($task->due_date);
    }

    public function getStatus(): DeliveryStatus
    {
        return DeliveryStatus::OVERDUE;
    }
}
