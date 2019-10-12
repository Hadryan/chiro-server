<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentences(3, true),
        'image_path' => public_relative_path($faker->image(public_path('images/categories')))
    ];
});
