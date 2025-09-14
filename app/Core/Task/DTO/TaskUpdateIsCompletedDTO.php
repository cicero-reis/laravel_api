<?php

namespace App\Core\Task\DTO;

class TaskUpdateIsCompletedDTO
{
    public int $id;

    public string $is_completed;

    public function __construct(int $id, int $isCompleted)
    {
        $this->id = $id;
        $this->is_completed = $isCompleted;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'is_completed' => $this->is_completed,
        ];
    }
}
