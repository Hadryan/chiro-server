<?php

namespace Tests;

use App\Model\City;
use App\Model\User;
use App\Model\ShippingAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createSampleUser(): User
    {
        return User::create([
            'phone' => '09123456789',
            'name' => 'Hamed Momeni',
            'email' => 'hamed.ma7@gmail.com',
            'password' => Hash::make('password')
        ]);
    }

    protected function createSampleShippingAddress(int $userId, int $cityid): ShippingAddress
    {
        return ShippingAddress::create([
            'name' => 'Home',
            'user_id' => $userId,
            'city_id' => $cityid,
            'lat' => 0,
            'lng' => 0,
            'address' => 'Manhattan #1222'
        ]);
    }

    protected function createSampleCity(): City
    {
        return City::create([
            'name' => 'San Francisco',
        ]);
    }
}
