<?php

namespace App\Core\User\DTO;

use Illuminate\Support\Facades\Hash;

class UserCreateDTO
{
    public string $name;
    public string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('password')
        ];
    }
}