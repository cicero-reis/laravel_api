<?php

namespace App\Core\User\DTO\Factories;

use App\Core\User\DTO\UserUpdateDTO;

class UserUpdateDTOFactory
{
    public static function updateFromArray(array $data): UserUpdateDTO
    {
        return new UserUpdateDTO(
            id: $data['id'] ?? 0,
            name: $data['name'] ?? '',
            email: $data['email'] ?? ''
        );
    }
}
