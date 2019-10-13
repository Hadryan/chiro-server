<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'path' => random_mock_image()
    ];
});
