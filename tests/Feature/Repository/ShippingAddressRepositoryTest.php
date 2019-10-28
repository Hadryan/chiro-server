<?php

use App\Model\City;
use App\Model\User;
use Tests\TestCase;
use App\Model\ShippingAddress;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ShippingAddressRepositoryTest extends TestCase
{

    public function testInsertException()
    {
        $this->expectException(ValidationException::class);
        app('shippingAddresses')->insert([], 1);
    }

    public function testInsert()
    {

        $c = City::first();
        $u = User::first();


        app('shippingAddresses')->insert([
            'name' => 'My Home',
            'address' => '123 Main St',
            'city_id' => $c->id,
        ], $u->id);

        $this->assertDatabaseHas('shipping_addresses', [
            'name' => 'My Home',
        ]);
    }

    public function testGet()
    {

        $c = City::first();
        $u = User::first();


        $shippingAddress = app('shippingAddresses')->insert([
            'name' => 'My Home',
            'address' => '123 Main St',
            'city_id' => $c->id,
        ], $u->id);

        $sa = app('shippingAddresses')->get($shippingAddress->id);

        $this->assertEquals($shippingAddress->id, $sa->id);
    }

    public function testGetNotFound()
    {

        $this->expectException(ModelNotFoundException::class);

        app('shippingAddresses')->get(45435);
    }

    public function testGetAddressesForUser()
    {

        $adrss = ShippingAddress::where('user_id', 1)->get();

        $adrs2 = app('shippingAddresses')->getAddressesForUser(1);

        $this->assertEquals($adrss, $adrs2);
    }
}
