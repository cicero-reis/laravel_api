<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Infrastructure\Enums\JWTAuthEnum;
use App\Infrastructure\JWT\Interfaces\LogoutServiceInterface;
use Tymon\JWTAuth\Exceptions\JWTException;

class LogoutController
{
    public LogoutServiceInterface $logoutService;

    public function __construct(LogoutServiceInterface $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function __invoke()
    {
        try {
            $this->logoutService->execute();

            return response()->json(['message' => 'Logout realizado com sucesso!'], JWTAuthEnum::HTTP_OK);
        } catch (JWTException $e) {
            return handleTokenException($e);
        }
    }
}
