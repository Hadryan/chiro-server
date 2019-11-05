<?php

namespace App\Services\SMS;

class Kavenegar extends SmsBase implements SmsInterface
{
    public function __construct()
    {
        parent::__construct(
            sprintf(
                'https://api.kavenegar.com/v1/%s/',
                config('sms_providers.providers.kavenegar.api_key')
            )
        );
    }
    public function sendOtp(string $phone, string $code): string
    {
        try {
            $this->guzzle->post('verify/lookup.json', [
                'query' => [
                    'token' => $code,
                    'receptor' => $this->normalizePhoneNumber($phone),
                    'template' => config('sms_providers.providers.kavenegar.auth_template')
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error("failed sending request to Kavenegar", ['original' => $e]);
            throw new SmsException($e->getMessage());
        }
        return $code;
    }
}
