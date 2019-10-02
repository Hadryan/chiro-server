<?php

namespace App\Services\SMS;

interface SmsInterface
{
    public function sendOtp(string $phone): string;
}
