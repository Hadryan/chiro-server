<?php

use App\Model\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(City::class, 10)->create();

        $cities = City::all();

        factory(City::class, 100)->create()->each(function ($city) use ($cities) {
            $city->parent()->associate($cities->random());
        });
    }
}
