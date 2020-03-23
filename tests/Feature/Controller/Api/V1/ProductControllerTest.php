<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Model\Product;
use \Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

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
                'image_url'
            ]
        ]);
    }

    public function testSingleProduct()
    {

        $products = Product::limit(1)->get();

        $response = $this->get('/api/v1/products/' . $products[0]->id);

        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'name',
            'price',
            'discount',
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

        $response = $this->get('/api/v1/products/search?query=' . $query, ['Accept' => 'application/json']);

        $response->assertOk();

        // $items = $response->getContent();

        $response->assertJsonStructure([[
            'name',
            'description',
            'price',
            'image_url'
        ]]);
    }

    public function test_products_by_category()
    {
        $product = Product::all()->first();
        $response = $this->get('api/v1/categories/' . $product->categories->get(0)->id . '/products');

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [array_diff(array_keys($product->toArray()), ['categories'])],
            'total',
            'from',
            'to'
        ]);
    }
}
