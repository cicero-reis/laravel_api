<?php

namespace App\Core\Task\DTO\Factories;

use App\Core\Task\DTO\TaskUpdateDTO;

class TaskUpdateDTOFactory
{
    public static function updateFromArray(array $data): TaskUpdateDTO
    {
        return new TaskUpdateDTO(
            id: $data['id'] ?? 0,
            name: $data['name'] ?? ''
        );
    }
}