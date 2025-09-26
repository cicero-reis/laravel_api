<?php

namespace App\Core\User\DTO;

class UserUpdateFCMTokenDTO
{
    public int $id;
    public string $fcm_token;

    public function __construct(int $id, string $fcm_token)
    {
        $this->id = $id;
        $this->fcm_token = $fcm_token;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'fcm_token' => $this->fcm_token,
        ];
    }
}
