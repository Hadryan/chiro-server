<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use App\Services\JWT\JWTServiceInterface;
use App\Model\User;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->headers->get('Authorization');
        $token = explode(' ', $token);
        $token = $token[1] ?? '';

        $jwtService = app(JWTServiceInterface::class);

        if (!$jwtService->validateJwtToken($token)) {
            throw new AuthenticationException();
        }

        $uid = $jwtService->getClaims()['uid'];
        auth('api')->setUser(User::find($uid));
    }
}
