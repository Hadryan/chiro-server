<?php

namespace App\Http\Controllers\Api\V1;

use \App\Model\Customer;
use Illuminate\Http\Request;
use App\Services\SMS\SmsInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;
use \App\Services\JWT\JWTServiceInterface;

class AuthController extends Controller
{

    const OTP_PHONE_PREFIX = "otp_";

    public function request(Request $request, SmsInterface $smsService)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:@^(0|98)9[0-9]{9}$@']
        ]);

        if ($validator->fails()) {
            return $this->fail($validator->errors(), 400);
        }

        $phone = $request->input('phone');
        $code = (string) mt_rand(11111, 99999);


        $response = [];
        if (!$request->hasHeader('X-Debug')) {
            $code = $smsService->sendOtp($phone, $code);
        } else {
            $response['code'] = $code;
        }

        Cache::put(self::OTP_PHONE_PREFIX . $phone, $code, 120);

        return $this->respond($response, 200, __("auth.otp_code_sent"));
    }

    public function verify(Request $request, JWTServiceInterface $jwtService)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required', 'regex:@^(0|98)9[0-9]{9}$@'],
            'code' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->fail($validator->errors(), 400);
        }

        $phone = $request->input('phone');
        $code = $request->input('code');

        $correctCode = Cache::get(self::OTP_PHONE_PREFIX . $phone);

        Cache::delete(self::OTP_PHONE_PREFIX . $phone);

        if ($code !== $correctCode) {
            return $this->fail(__('auth.incorrect_code'), 401);
        }

        $customer = Customer::where('phone', $phone)->first();

        if ($customer === null) {
            $customer = Customer::create([
                'phone' => $phone,
                'name' => '',
            ]);
        }

        $token = $jwtService->generateJwtToken([
            'uid' => $customer->id,
        ]);

        return $this->respond([
            'customer' => $customer->toArray(),
            'token' => $token
        ]);
    }
}
