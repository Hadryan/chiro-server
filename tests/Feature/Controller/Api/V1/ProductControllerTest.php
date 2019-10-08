<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;

class ProductControllerTest extends TestCase
{
    public function testListProducts()
    {

        $products = Product::paginate()->items();

        $response = $this->get('/api/v1/products');

        $response->assertOk();
        $response->assertJsonCount(count($products));
    }
}
