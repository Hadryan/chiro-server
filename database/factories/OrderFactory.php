<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Order;
use App\Model\Customer;
use Faker\Generator as Faker;
use App\Model\ShippingAddress;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => function () {
            return Customer::all()->random(1)[0]->id;
        },
        'address_id' => function () {
            return ShippingAddress::all()->random(1)[0]->id;
        }
    ];
});
