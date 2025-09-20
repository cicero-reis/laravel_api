<?php

namespace App\Core\Task\Services\Delivery;

class DeliveryStatusService
{
    protected array $strategies;

    public function __construct()
    {
        $this->strategies = [
            new WithinDeadline,
            new DueToday,
            new Overdue,
        ];
    }

    public function getStatus($task): ?array
    {
        foreach ($this->strategies as $strategy) {

            if ($strategy->applies($task)) {

                $status = $strategy->getStatus();

                return [
                    'value' => $status->value,
                    'color' => $status->color(),
                ];
            }
        }

        return null;
    }
}
