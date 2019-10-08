<?php

namespace App\Services\SMS;

class Bitel extends SmsBase implements SmsInterface
{

    public function __construct()
    {
        parent::__construct('https://api.bitel.rest');
    }

    public function sendCodeBySms(string $phone, string $code): bool
    {
        try {
            $this->guzzle->post('api/v2/sms/otp', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('bitel.AUTH_CODE')
                ],
                'json' => [
                    'message' => 'کد فعال سازی شما:' . $code,
                    'phoneNumber' => $this->normalizePhoneNumber($phone),
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }
}
