<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use App\Model\ProductProperties;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(1000, 100000),
        'description' => $faker->sentences(3, true),
        'discount' => $faker->numberBetween(0, 90),
    ];
});
