<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Model\Slide;
use Faker\Generator as Faker;

$factory->define(Slide::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'alt' => $faker->sentences(3, true),
        'target_url' => $faker->url,
        'image_path' => random_mock_image(),
    ];
});
