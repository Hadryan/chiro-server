<?php

namespace Tests;

use App\Model\City;
use App\Model\User;
use App\Model\Category;
use App\Model\ShippingAddress;
use Illuminate\Support\Facades\Hash;
use App\Services\JWT\JWTServiceInterface;
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

    protected function createSampleCategory()
    {
        return Category::create([
            'name' => 'Category',
            'parent_id' => null,
            'description' => 'Category description',
            'image_path' => random_mock_image(),
            'type' => 'category',
        ]);
    }

    protected function getJwt($user = null)
    {
        $user = $user ?? $this->createSampleUser();
        return app(JWTServiceInterface::class)->generateJwtToken([
            'uid' => $user->id
        ]);
    }
}
