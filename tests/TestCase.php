<?php

namespace Tests;

use App\Model\City;
use App\Model\Category;
use App\Model\Customer;
use App\Model\ShippingAddress;
use Illuminate\Support\Facades\Hash;
use App\Services\JWT\JWTServiceInterface;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function __construct()
    {
        parent::__construct();
        $this->withoutExceptionHandling();
    }

    protected function createSampleCustomer(): Customer
    {
        return Customer::create([
            'phone' => '09123456789',
            'name' => 'Hamed Momeni',
            'email' => 'hamed.ma7@gmail.com',
            'password' => Hash::make('password')
        ]);
    }

    protected function createSampleShippingAddress(int $customerId, int $cityid): ShippingAddress
    {
        return ShippingAddress::create([
            'name' => 'Home',
            'customer_id' => $customerId,
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

    protected function getJwt($customer = null)
    {
        $customer = $customer ?? $this->createSampleCustomer();
        return app(JWTServiceInterface::class)->generateJwtToken([
            'uid' => $customer->id
        ]);
    }
}
