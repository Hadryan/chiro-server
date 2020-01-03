<?php

namespace Tests\Feature;

use App\Model\ShippingAddress;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShippingAddressControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $user, $jwt;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createSampleUser();
        $this->jwt = $this->getJwt($this->user);
    }

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
        $this->createSampleShippingAddress($this->user->id, $this->createSampleCity()->id);

        $response = $this->get('api/v1/addresses', [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->jwt
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
                // 'city_id' => 1, // intentionally omitted
                'lat' => '55.123456',
                'lng' => '33.3243567'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->jwt
            ]
        );

        $response->assertStatus(422);
    }

    /**
     * @test
     */
    public function testInsertAddress()
    {
        $city = $this->createSampleCity();
        $response = $this->post(
            'api/v1/addresses',
            [
                'name' => 'Home',
                'address' => 'Ever green terece',
                'city_id' => $city->id,
                'lat' => '55.123456',
                'lng' => '33.3243567'
            ],
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->jwt
            ]
        );

        $response->assertStatus(201);

        $response->assertJsonStructure(['name', 'user_id', 'city_id', 'lat', 'lng', 'address']);

        $address = ShippingAddress::find($response->original->id);

        $this->assertEquals('Ever green terece', $address->address);
    }
}
