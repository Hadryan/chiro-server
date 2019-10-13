<?php

function public_relative_path($path = '')
{
    return str_ireplace(base_path('public'), '', public_path($path));
}


function random_mock_image()
{
    $imageNames = [
        '0ee595799356f2ea5df6f5d73bfc108d.jpg',
        '1e84fac609f5c838a5de4cadffa9a72b.jpg',
        '28444e1ad810ae33317a8d1fed1fe9b3.jpg',
        '3d1e3651b9df337f8a07a9804ec377d8.jpg',
        '54ac4d09e2a8bd36698ad3ef8f259a46.jpg',
        '71894ab812b4a7d24f6df7915d914aff.jpg',
        '89255a49fa29b2019149cd2067b21a96.jpg',
        '8d2f441d40c2e82de4ba8ab09091641b.jpg',
        '97eedcfd3d5f4819098ec60101563359.jpg',
        'a76aaad3e61f0d6a7b0820965c6836fc.jpg',
        'c48f6cd07a8efc39afc51be436afdfbd.jpg',
        'c6164d7749a2f9528f023d7b289a0ac7.jpg',
        'de08b9d8e11d952ccb80ddadc241fdd1.jpg',
        'e4aeaf37df73e3559577d4bebaf8dbd2.jpg',
        'fa5ad3ccecb226fcf085d7b274e81f6f.jpg',
    ];

    return public_relative_path('mocks/' . $imageNames[mt_rand(0, count($imageNames) - 1)]);
}
