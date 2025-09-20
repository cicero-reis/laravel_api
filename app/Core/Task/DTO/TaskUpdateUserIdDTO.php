<?php

namespace App\Core\Task\DTO;

class TaskUpdateUserIdDTO
{
    public int $id;

    public int $user_id;

    public function __construct(int $id, int $userId)
    {
        $this->id = $id;
        $this->user_id = $userId;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
        ];
    }
}
