<?php

return [
    'provider' => env('SMS_PROVIDER', 'kavenegar'),
    'providers' => [
        'kavenegar' => [
            'api_key' => env('KAVENEGAR_APIKEY'),
            'auth_template' => env('KAVENEGAR_AUTH_TEMPLATE')
        ],
        'bitel' => [
            'api_key' => env('BITEL_AUTH_CODE')
        ]
    ]
];
