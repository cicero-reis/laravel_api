<?php

namespace App\Infrastructure\JWT\Services;

use App\Infrastructure\JWT\Interfaces\LogoutServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutService implements LogoutServiceInterface
{
    public function execute(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }
}
