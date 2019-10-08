<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use App\Services\JWT\JWTServiceInterface;
use App\Model\User;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    public function redirectTo($request)
    { }
}
