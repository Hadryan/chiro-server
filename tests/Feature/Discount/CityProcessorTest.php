<?php

namespace Tests\Discount;

use App\Model\User;
use Tests\TestCase;
use App\Model\Discount;

class CityProcessorTest extends TestCase
{

    private $city, $user, $address, $discount;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createSampleUser();
        $this->city = $this->createSampleCity();
        $this->address = $this->createSampleShippingAddress($this->user->id, $this->city->id);

        $this->discount = Discount::create([
            'code' => null,
            'type' => 'fixed',
            'on' => 'shipping_city',
            'target_id' => $this->city->id,
            'amount' => 2000,
        ]);
    }

    protected function tearDown(): void
    {
        $this->discount->destroy();
        $this->address->destroy();
        $this->city->destroy();
        $this->user->destroy();
        parent::tearDown();
    }

    public function test_city_processor()
    {
        dd(User::all());
    }
}
