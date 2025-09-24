<?php

namespace App\Core\Task\DTO\Factories;

use App\Core\Task\DTO\TaskCreateDTO;

class TaskCreateDTOFactory
{
    public static function createFromArray(array $data): TaskCreateDTO
    {
        return new TaskCreateDTO(
            name: $data['name'] ?? '',
            priority: $data['priority'] ?? '',
        );
    }
}
