<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Requests\AuthLoginRequest;
use App\Infrastructure\DTO\LoginDTO;
use App\Infrastructure\DTO\TokenResponseDTO;
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

            return response()->json($tokenDto->toArray(), 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
