<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;
use App\Model\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();
        return $this->respond($products->items());
    }

    public function single($id)
    {
        $product = Product::find($id);

        return $this->respond($product);
    }
}
