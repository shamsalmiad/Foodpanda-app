<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Auth\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthFromAccessToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'No token provided'], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken || !$accessToken->tokenable) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        // Optionally check if token is expired manually:
        // if ($accessToken->expires_at && now()->greaterThan($accessToken->expires_at)) {
        //     return response()->json(['error' => 'Token expired'], 401);
        // }

        auth()->login($accessToken->tokenable);

        return $next($request);
    }
}
