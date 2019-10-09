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

    public function testSingleProduct()
    {
        $response = $this->get('/api/v1/products/1');

        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'name',
            'price',
            'discount',
            'properties',
        ]);
    }

    public function testSignleProductInvalidId()
    {
        $response = $this->get('/api/v1/products/wrongId');

        $response->assertNotFound();
    }
}
