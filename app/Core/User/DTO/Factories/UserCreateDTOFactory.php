<?php

namespace App\Core\User\DTO\Factories;

use App\Core\User\DTO\UserCreateDTO;

class UserCreateDTOFactory
{
    public static function createFromArray(array $data): UserCreateDTO
    {
        return new UserCreateDTO(
            name: $data['name'] ?? '',
            email: $data['email'] ?? '',
        );
    }
}
