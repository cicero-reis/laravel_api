<?php

namespace App\Core\Task\DTO\Factories;

use App\Core\Task\DTO\TaskUpdateUserIdDTO;

class TaskUpdateUserIdDTOFactory
{
    public static function updateUserIdFromArray(array $data): TaskUpdateUserIdDTO
    {
        return new TaskUpdateUserIdDTO(
            id: $data['id'] ?? 0,
            userId: $data['user_id'] ?? 0
        );
    }
}
