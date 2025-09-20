<?php

namespace App\Core\Task\Services\Delivery\Interfaces;

use App\Core\Task\Services\Enums\DeliveryStatus;

interface DeliveryStatusStrategyInterface
{
    public function applies($task): bool;

    public function getStatus(): DeliveryStatus;
}
