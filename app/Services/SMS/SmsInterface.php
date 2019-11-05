<?php

namespace App\Services\SMS;

use App\Services\SMS\SmsException;

interface SmsInterface
{
    /**
     * sends a verification sms to the requested phone number with code supplied
     * @param string $phone the recipient phone number
     * @param string $code the verification code\
     * @return string returns the code supplied
     * @throws SmsException
     */
    public function sendOtp(string $phone, string $code): string;
}
