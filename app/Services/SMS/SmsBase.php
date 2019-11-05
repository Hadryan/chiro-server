<?php

namespace App\Services\SMS;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

class SmsBase
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzle;

    public function __construct($baseUrl)
    {
        $this->guzzle = app(ClientInterface::class, [
            'base_uri' => $baseUrl,
            'allow_redirects' => true,
            'timeout' => 3,
        ]);
    }

    public function normalizePhoneNumber($phone)
    {
        $newNumbers = range(0, 9);
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $string = str_replace($arabic, $newNumbers, $phone);
        $string = str_replace($persian, $newNumbers, $string);
        $string = str_replace(' ', '', $string);
        return $string;
    }
}
