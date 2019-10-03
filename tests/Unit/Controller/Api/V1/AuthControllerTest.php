<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * @Test
     */
    public function testRequest()
    {

        $this->mock(\App\Services\SMS\SmsInterface::class, function ($mock) {
            $mock->shouldReceive('sendOtp')->andReturn('1234');
        });

        $response = $this->post('api/v1/auth/request', ['phone' => '09124092353']);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => null,
            'message' => __("auth.otp_code_sent")
        ]);
    }
}
