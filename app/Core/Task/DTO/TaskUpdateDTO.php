<?php

namespace App\Core\Task\DTO;

class TaskUpdateDTO
{
    public int $id;

    public string $name;

    public int $priority;

    public function __construct(int $id, string $name, int $priority)
    {
        $this->id = $id;
        $this->name = $name;
        $this->priority = $priority;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'priority' => $this->priority,
        ];
    }
}
