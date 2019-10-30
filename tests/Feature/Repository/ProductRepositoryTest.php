<?php

use App\Model\Order;

class ProductRepositoryTest extends \Tests\TestCase
{

    public function testInsert()
    {
        $orders = Order::with(['products'])->get()->toArray();

        dd($orders);
    }
}
