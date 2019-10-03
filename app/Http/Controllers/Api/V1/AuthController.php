<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;
use App\Services\SMS\SmsInterface;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{

    const OTP_PHONE_PREFIX = "otp_";

    public function request(Request $request, SmsInterface $smsService)
    {
        $phone = $request->input('phone');

        $code = $smsService->sendOtp($phone);

        Redis::set(self::OTP_PHONE_PREFIX . $phone, $code);

        return $this->respond(null, 200, __("auth.otp_code_sent"));
    }
}
