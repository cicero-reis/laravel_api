<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public const UNAUTHORIZED_STATUS = 403;

    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        Log::info('Role check', [
            'user_role' => optional($request->user())->role,
            'allowed_roles' => $roles
        ]);
        
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            return response()->json(['message' => 'Unauthorized'], self::UNAUTHORIZED_STATUS);
        }

        return $next($request);
    }
}
