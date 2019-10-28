<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\User;
use App\Model\Order;
use Faker\Generator as Faker;
use App\Model\ShippingAddress;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return User::all()->random(1)[0]->id;
        },
        'address_id' => function () {
            return ShippingAddress::all()->random(1)[0]->id;
        }
    ];
});
