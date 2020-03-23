<?php

namespace App\Repository;

use App\Model\Product;
use App\Model\ProductImage;
use \Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function insert(array $data, string $imagePath = null): Product
    {
        $product = Product::create($data);

        if ($imagePath !== null) {

            $productImage = ProductImage::create([
                'path' => $imagePath
            ]);

            $product->images()->save($productImage);
        }
        return $product;
    }

    public function get(int $id, $with = ['images', 'categories']): Product
    {
        return Product::with($with)->findOrFail($id);
    }

    public function all(): array
    {
        return Product::all();
    }

    public function delete(int $id): bool
    {
        return Product::delete($id);
    }

    public function search(array $keywords, $or = true)
    {

        $operator = $or ? 'orWhere' : 'where';

        $query = (new Product())->newQuery();

        foreach ($keywords as $k) {
            $query = $query->$operator('name', 'like', sprintf('%%%s%%', $k));
            $query = $query->$operator('description', 'like', sprintf('%%%s%%', $k));
        }

        return $query->paginate();
    }
}
