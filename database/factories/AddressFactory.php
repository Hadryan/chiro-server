<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\City;
use App\Model\User;
use Faker\Generator as Faker;
use App\Model\ShippingAddress;

$factory->define(ShippingAddress::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => function () {
            return User::all()->random(1)[0]->id;
        },
        'city_id' => function () {
            return City::all()->random(1)[0]->id;
        },
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'address' => $faker->sentences(1, true),
    ];
});
