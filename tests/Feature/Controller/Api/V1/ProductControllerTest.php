<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{

    // use RefreshDatabase;

    // protected function setUp(): void
    // {
    //     parent::setUp();
    //     $this->seed();
    // }
    public function testListProducts()
    {

        $response = $this->get('/api/v1/products');

        $response->assertOk();
        $response->assertJsonStructure([
            [
                'id',
                'name',
                'price',
                'discount',
                'properties',
                'image_url'
            ]
        ]);
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
            'images',
            'categories',
        ]);
    }

    public function testSignleProductInvalidId()
    {
        $response = $this->get('/api/v1/products/wrongId');

        $response->assertNotFound();
    }

    public function testStoreProduct()
    {
        $response = $this->post('/api/v1/products', [
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 1000,
        ]);

        $response->assertStatus(201);
        // $body = json_decode($response->getBody());
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product'
        ]);
    }
}
