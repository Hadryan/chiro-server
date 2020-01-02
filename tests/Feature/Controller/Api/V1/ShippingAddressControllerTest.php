<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;

class ShippingAddressControllerTest extends TestCase
{
    /**
     * @Test
     */
    public function testIndexUnAuthenticated()
    {
        $response = $this->get('api/v1/addresses', ['Accept' => 'application/json']);

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function testIndex()
    {
        $response = $this->get('api/v1/addresses', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE1Nzc5ODYxNTUsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInVpZCI6MTAxfQ.JVseveeQpTyoMTjEM4_Nle8XcRsqg-lNZ4RueOMPmNRy-_vuPWT3isgp3slQHgnv51UlPfqZDkjwmzWzGG3hkg'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            ['name', 'user_id', 'city_id', 'lat', 'lng', 'address']
        ]);
    }
}
