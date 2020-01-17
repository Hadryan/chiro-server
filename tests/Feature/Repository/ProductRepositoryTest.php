<?php

use App\Model\Order;
use App\Model\ProductProperties;
use App\Repository\ProductRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductRepositoryTest extends \Tests\TestCase
{
    use DatabaseTransactions;

    /** @var ProductRepository */
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ProductRepository();
    }
    public function testInsert()
    {
        $product = $this->repository->insert([
            'name' => 'My Product',
            'description' => 'this is my product',
            'price' => 10000,
            'discount' => 10
        ], 'fake/image/path.png');

        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
    }
}
