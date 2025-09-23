<?php

namespace App\Infrastructure\JWT\DTO;

use Tymon\JWTAuth\Facades\JWTAuth;

class TokenResponseDTO
{
    public string $accessToken;

    public string $tokenType;

    public int $expiresIn;

    public function __construct(
        string $accessToken,
        string $tokenType,
        int $expiresIn
    ) {
        $this->accessToken = $accessToken;
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
    }

    public static function fromToken(string $token): self
    {
        return new self(
            accessToken: $token,
            tokenType: 'bearer',
            expiresIn: (string) JWTAuth::factory()->getTTL() * 60
        );
    }

    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'token_type' => $this->tokenType,
            'expires_in' => $this->expiresIn,
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
