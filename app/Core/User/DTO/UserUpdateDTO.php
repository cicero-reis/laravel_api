<?php

namespace App\Core\User\DTO;

class UserUpdateDTO
{
    public int $id;
    public string $name;
    public string $email;

    public function __construct(int $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
