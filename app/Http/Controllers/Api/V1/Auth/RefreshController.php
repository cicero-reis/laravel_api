<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Infrastructure\JWT\DTO\TokenResponseDTO;
use App\Infrastructure\JWT\Enums\JWTAuthEnum;
use App\Infrastructure\JWT\Interfaces\RefreshServiceInterface;
use Tymon\JWTAuth\Exceptions\JWTException;

class RefreshController
{
    public RefreshServiceInterface $refreshService;

    public function __construct(RefreshServiceInterface $refreshService)
    {
        $this->refreshService = $refreshService;
    }

    public function __invoke()
    {
        try {
            $newToken = $this->refreshService->execute();
            $tokenDto = TokenResponseDTO::fromToken($newToken);

            return response()->json($tokenDto->toArray(), JWTAuthEnum::HTTP_OK);
        } catch (JWTException $e) {
            return handleTokenException($e);
        }
    }
}
