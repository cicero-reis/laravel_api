<?php

use App\Infrastructure\JWT\Enums\JWTAuthEnum;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

if (! function_exists('handleTokenException')) {
    function handleTokenException(JWTException $e): JsonResponse
    {
        if ($e instanceof TokenBlacklistedException) {
            return errorResponse(JWTAuthEnum::ERROR_TOKEN_BLACKLISTED, 'token_blacklisted', JWTAuthEnum::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof TokenExpiredException) {
            return errorResponse(JWTAuthEnum::ERROR_TOKEN_EXPIRED, 'token_expired', JWTAuthEnum::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof TokenInvalidException) {
            return errorResponse(JWTAuthEnum::ERROR_TOKEN_INVALID, 'token_invalid', JWTAuthEnum::HTTP_UNAUTHORIZED);
        }

        return errorResponse(JWTAuthEnum::ERROR_TOKEN_PROCESSING, 'token_error', JWTAuthEnum::HTTP_SERVER_ERROR);
    }
}

if (! function_exists('errorResponse')) {
    function errorResponse(string $message, string $error, int $status): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'error' => $error,
        ], $status);
    }
}

if (! function_exists('taskSummaryCollection')) {
    function taskSummaryCollection($user) {
        return $user->map(function ($user) {
            $total = $user->tasks->count();
            $onTime = 0;
            $late = 0;
            $pending = 0;
    
            foreach ($user->tasks as $task) {
                if ($task->completed_at) {
                    if ($task->completed_at <= $task->due_date) {
                        $onTime++;
                    } else {
                        $late++;
                    }
                } else {
                    $pending++;
                }
            }
    
            return [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'task_summary' => [
                    'total'   => $total,
                    'on_time' => $onTime,
                    'late'    => $late,
                    'pending' => $pending,
                    'percent_on_time' => $total > 0 ? round(($onTime / $total) * 100, 2) : 0
                ]
            ];
        });
    }
}
