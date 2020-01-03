<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CustomerSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(SlideTableSeeder::class);
    }
}
