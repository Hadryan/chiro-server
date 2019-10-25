<?php

use Tests\TestCase;

class ShippingAddressRepositoryTest extends TestCase
{
    public function testInsert()
    {
        app('shippingAddresses')->insert([
            'name' => 'My Home',
            'address' => '123 Main St',
            'city_id' => 1,
        ], 1);

        $this->assertDatabaseHas('shipping_addresses', [
            'name' => 'My Home',
        ]);
    }
}
