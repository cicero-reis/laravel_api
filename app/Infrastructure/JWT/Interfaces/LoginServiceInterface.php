<?php

namespace App\Infrastructure\JWT\Interfaces;

use App\Infrastructure\JWT\DTO\LoginDTO;

interface LoginServiceInterface
{
    public function execute(LoginDTO $loginDTO): ?string;
}
