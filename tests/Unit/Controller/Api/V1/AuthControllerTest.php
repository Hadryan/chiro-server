<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
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
        $response->assertJson([
            'data' => null,
            'message' => __("auth.otp_code_sent")
        ]);
    }
    /**
     * @Test
     */
    public function testRequestInvalidPhone()
    {

        $response = $this->post('api/v1/auth/request', ['phone' => '0912345']);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => __('auth.invalid_params')
        ]);

        $response = $this->post('api/v1/auth/request', []);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => __('auth.invalid_params')
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
            'message' => __('auth.invalid_params')
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
        $fakeUser = new \App\Model\User([
            'id' => 1,
            'name' => 'Hamed Momeni',
            'email' => 'hamed@test.com',
            'phone' => '09123456789',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        $this->mock(\App\Model\User::class, function ($mock) use ($fakeUser) {
            $mock->shouldReceive('create')->andReturn($fakeUser->toArray());
        });

        $response = $this->post('api/v1/auth/verify', [
            'phone' => '09123456789',
            'code' => '12345'
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'user' => $fakeUser->toArray()
            ]
        ]);
    }
}
