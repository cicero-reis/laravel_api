<?php

namespace App\Core\User\DTO\Factories;

use App\Core\User\DTO\UserUpdateFCMTokenDTO;

class UserUpdateFCMDTOFactory
{
    public static function updateFromArray(array $data): UserUpdateFCMTokenDTO
    {
        return new UserUpdateFCMTokenDTO(
            id: $data['id'] ?? 0,
            fcm_token: $data['fcm_token'] ?? ''
        );
    }
}
