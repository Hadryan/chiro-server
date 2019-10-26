<?php

use App\Repository\Product\ProductRepository;

class ProductRepositoryTest extends \Tests\TestCase
{
    /** @var ProductRepository */
    protected $repository;

    protected function setUp()
    {
        parent::setUp();
        $this->repository = new ProductRepository();
    }
    public function testInsert()
    {
        $data = [];

        $this->repository->insert($data);
    }
}
