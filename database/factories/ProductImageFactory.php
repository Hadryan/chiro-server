<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\ProductImage;
use Faker\Generator as Faker;

$factory->define(ProductImage::class, function (Faker $faker) {
    return [
        'path' => public_relative_path($faker->image(public_path('images')))
    ];
});
