<?php

namespace App\Core\Task\Services\Enums;

enum DeliveryStatus: string
{
    case WITHIN_DEADLINE = 'Within deadline';
    case DUE_TODAY = 'Due today';
    case OVERDUE = 'Overdue';

    public function color(): string
    {
        return match ($this) {
            self::WITHIN_DEADLINE => 'green',
            self::DUE_TODAY => 'yellow',
            self::OVERDUE => 'red'
        };
    }
}
