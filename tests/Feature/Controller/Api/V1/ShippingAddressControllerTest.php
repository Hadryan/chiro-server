<?php

namespace Tests\Feature;

use App\Model\City;
use App\Model\ShippingAddress;
use Tests\TestCase;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShippingAddressControllerTest extends TestCase
{
    use DatabaseTransactions;
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

    /**
     * @test
     */
    public function testInsertAddressWithInvalidData()
    {
        $response = $this->post(
            'api/v1/addresses',
            [
                'name' => 'Home',
                'address' => 'Ever green terece',
                // 'city_id' => 1,
                'lat' => '55.123456',
                'lng' => '33.3243567'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE1Nzc5ODYxNTUsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInVpZCI6MTAxfQ.JVseveeQpTyoMTjEM4_Nle8XcRsqg-lNZ4RueOMPmNRy-_vuPWT3isgp3slQHgnv51UlPfqZDkjwmzWzGG3hkg'
            ]
        );

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function testInsertAddress()
    {
        $response = $this->post(
            'api/v1/addresses',
            [
                'name' => 'Home',
                'address' => 'Ever green terece',
                'city_id' => 1,
                'lat' => '55.123456',
                'lng' => '33.3243567'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE1Nzc5ODYxNTUsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdCIsInVpZCI6MTAxfQ.JVseveeQpTyoMTjEM4_Nle8XcRsqg-lNZ4RueOMPmNRy-_vuPWT3isgp3slQHgnv51UlPfqZDkjwmzWzGG3hkg'
            ]
        );

        $response->assertStatus(201);

        $response->assertJsonStructure(['name', 'user_id', 'city_id', 'lat', 'lng', 'address']);

        $address = ShippingAddress::find($response->original->id);

        $this->assertEquals('Ever green terece', $address->address);
    }
}
