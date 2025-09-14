<?php

namespace App\Core\Task\DTO;

class TaskCreateDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name
        ];
    }
}
