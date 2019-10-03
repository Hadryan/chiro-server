<?php

namespace App\Services\JWT;

interface JWTServiceInterface
{
    public function generateJwtToken(array $claims): string;

    public function validateJwtToken(string $token): bool;
}
