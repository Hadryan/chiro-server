<?php

use App\Model\Order;
use App\Model\Product;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function (Order $order) {
            $order->products()->attach(Product::all()->random(3)->pluck('id')->toArray(), ['quantity' => mt_rand(1, 100), 'unit_price' => mt_rand(1000, 100000)]);
        });
    }
}
