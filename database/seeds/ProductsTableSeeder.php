<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Product::class, 20)->create()->each(function ($product) {
            $product->images()->save(factory(App\Model\ProductImage::class)->make());
        });
    }
}
