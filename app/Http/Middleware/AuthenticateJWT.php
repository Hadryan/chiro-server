<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Customer;
use Illuminate\Http\Request;
use App\Services\JWT\JWTServiceInterface;
use Illuminate\Auth\AuthenticationException;

class AuthenticateJWT
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

        $uid = $jwtService->getClaims($token)['uid'];
        auth('api')->setUser(Customer::find($uid));

        return $next($request);
    }
}
