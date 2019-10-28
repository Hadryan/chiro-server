<?php

use App\Model\ShippingAddress;
use Illuminate\Database\Seeder;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ShippingAddress::class, 100)->create();
    }
}
