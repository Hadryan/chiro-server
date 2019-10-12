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

        factory(App\Model\Category::class, 20)->create();

        $categories = App\Model\Category::all();

        App\Model\Product::all()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
