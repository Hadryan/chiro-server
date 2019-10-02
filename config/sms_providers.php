<?php

return [
    'provider' => env('SMS_PROVIDER', 'kavenegar'),
    'providers' => [
        'kavenegar' => [
            'api_key' => env('KAVENEGAR_APIKEY'),
        ],
        'bitel' => [
            'api_key' => env('BITEL_AUTH_CODE')
        ]
    ]
];
