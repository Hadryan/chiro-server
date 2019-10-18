<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Illuminate\Http\UploadedFile;

class ProductControllerTest extends TestCase
{

    // use RefreshDatabase;

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

    public function testStoreProductWithImage()
    {
        $response = $this->post('/api/v1/products', [
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 1000,
            'image' => UploadedFile::fake()->image("image.png", 200, 200),
        ], [
            'Accept' => 'application/json'
        ]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'name',
            'description',
            'price',
            'image_url'
        ]);
    }

    public function testProductSearch()
    {
        $products = Product::limit(3)->orderBy('created_at', 'ASC')->get();

        $query = '';

        $products->each(function ($product) use (&$query) {
            $query .= $product->name . ' ';
        });

        // dd($query);

        $response = $this->get('/api/v1/products/search?query=' . $query, ['Accept' => 'application/json']);

        $response->assertOk();

        $items = $response->getContent();

        $response->assertJsonStructure([[
            'name',
            'description',
            'price',
            'image_url'
        ]]);
    }
}
