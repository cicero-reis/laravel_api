<?php

namespace App\Core\Task\DTO\Factories;

use App\Core\Task\DTO\TaskUpdateIsCompletedDTO;

class TaskUpdateIsCompletedDTOFactory
{
    public static function updateIsCompletedFromArray(array $data): TaskUpdateIsCompletedDTO
    {
        return new TaskUpdateIsCompletedDTO(
            id: $data['id'] ?? 0,
            isCompleted: $data['is_completed'] ?? 0
        );
    }
}
