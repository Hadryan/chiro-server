<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\JWT\JWTService;

class JWTSerializerTest extends TestCase
{
    public function testGenerateJwtToken()
    {
        $jwtService = new JWTService('key');
        $token = $jwtService->generateJwtToken([
            'hamed' => 'Momeni',
            'email' => 'hamed@example.com',
        ]);
        $this->assertTrue($jwtService->validateJwtToken($token));
    }
}
