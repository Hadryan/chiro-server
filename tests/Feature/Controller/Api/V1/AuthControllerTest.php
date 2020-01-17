<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * @Test
     */
    public function testRequest()
    {

        $this->mock(\App\Services\SMS\SmsInterface::class, function ($mock) {
            $mock->shouldReceive('sendOtp')->andReturn('12345');
        });

        $response = $this->post('api/v1/auth/request', ['phone' => '09123456789']);

        $response->assertStatus(200);
        $response->assertJson([]);
    }
    /**
     * @Test
     */
    public function testRequestInvalidPhone()
    {

        $response = $this->post('api/v1/auth/request', ['phone' => '0912345']);

        $response->assertStatus(400);
        $response->assertJson([
            'messages' => [
                'phone' => []
            ]
        ]);

        $response = $this->post('api/v1/auth/request', []);

        $response->assertStatus(400);
        $response->assertJson([
            'messages' => [
                'phone' => []
            ]
        ]);
    }
    /**
     * @Test
     */
    public function testVerifyInvalid()
    {
        $response = $this->post('api/v1/auth/verify');

        $response->assertStatus(400);
        $response->assertJson([
            'messages' => [
                'phone' => [],
                'code' => [],
            ]
        ]);
    }

    /**
     * @Test
     * @depends testRequest
     */
    public function testVerifyUnsuccessful()
    {
        $response = $this->post('api/v1/auth/verify', [
            'phone' => '09124092353',
            'code' => '54321'
        ]);

        $response->assertStatus(401);
        $response->assertJson([
            'message' => __('auth.incorrect_code')
        ]);
    }

    /**
     * @Test
     * @depends testRequest
     */
    public function testVerifySuccssful()
    {

        $this->mock(\App\Services\SMS\SmsInterface::class, function ($mock) {
            $mock->shouldReceive('sendOtp')->andReturn('12345');
        });

        $this->post('api/v1/auth/request', ['phone' => '09123456789']);

        $response = $this->post('api/v1/auth/verify', [
            'phone' => '09123456789',
            'code' => '12345'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'customer' => [
                'phone' => '09123456789'
            ]
        ]);
    }
}
