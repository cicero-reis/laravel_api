<?php

namespace App\Core\Task\DTO;

class TaskCreateDTO
{
    public string $name;
    public string $priority;

    public function __construct(string $name, string $priority)
    {
        $this->name = $name;
        $this->priority = $priority;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'priority' => $this->priority            
        ];
    }
}
