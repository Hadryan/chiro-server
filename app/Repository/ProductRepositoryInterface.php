<?php

namespace App\Repository;

use App\Model\Product;

interface ProductRepositoryInterface
{
    /**
     * inserts a product into the underlying database
     * @param array $data
     * @param string $imagePath if supplied will insert a @var ProductImage and attach it to the product
     * @return Product
     * @throws \Exception
     */
    public function insert(array $data, string $imagePath = null): Product;

    /**
     * retrieves a product from the underlying database
     * @param int $id
     * @return Product
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id, array $with): Product;

    /**
     * retrieves all products from the underlying database
     * @return array of @var Product objects
     */
    public function all(): array;

    /**
     * deletes a product from the underlying database
     * @param int $id
     * @return bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete(int $id): bool;

    /**
     * retrieves products conatining the specified keywords
     * @param array $keywords words to looke for in title and description fields
     * @param bool $or whether to OR keywords or AND them
     * @return array
     */
    public function search(array $keywords, $or = true): \Illuminate\Support\Collection;
}
