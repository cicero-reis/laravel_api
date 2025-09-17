<?php

namespace App\Infrastructure\JWT\Services;

use App\Infrastructure\JWT\Interfaces\RefreshServiceInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshService implements RefreshServiceInterface
{
    public function execute(): ?string
    {
        return JWTAuth::parseToken()->refresh();
    }
}
