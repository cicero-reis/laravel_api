<?php

namespace App\Infrastructure\JWT\Services;

use App\Infrastructure\DTO\LoginDTO;
use App\Infrastructure\JWT\Interfaces\LoginServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService implements LoginServiceInterface
{
    public function execute(LoginDTO $loginDTO): ?string
    {
        return JWTAuth::attempt($loginDTO->toArray());
    }
}
