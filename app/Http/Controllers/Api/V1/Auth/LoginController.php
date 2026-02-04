<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\AuthLoginRequest;
use App\Infrastructure\JWT\DTO\LoginDTO;
use App\Infrastructure\JWT\DTO\TokenResponseDTO;
use App\Infrastructure\JWT\Enums\JWTAuthEnum;
use App\Infrastructure\JWT\Interfaces\LoginServiceInterface;

class LoginController
{
    public LoginServiceInterface $loginService;

    public function __construct(LoginServiceInterface $loginService)
    {
        $this->loginService = $loginService;
    }

    public function __invoke(AuthLoginRequest $request)
    {
        $loginDTO = LoginDTO::fromRequest($request->all());

        $token = $this->loginService->execute($loginDTO);

        if ($token) {
            $tokenDto = TokenResponseDTO::fromToken($token);

            return response()->json($tokenDto->toArray(), JWTAuthEnum::HTTP_OK);
        }

        return response()->json(['error' => 'Unauthorized'], JWTAuthEnum::HTTP_UNAUTHORIZED);
    }
}
