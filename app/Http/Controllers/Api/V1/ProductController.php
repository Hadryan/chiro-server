<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories'])->paginate();
        return $this->respond($products->items());
    }

    public function single($id)
    {
        $product = Product::with(['images', 'categories'])->find($id);

        return $this->respond($product);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'numeric'
        ]);
        $product = Product::create($request->all());

        return $this->respond($product, 201);
    }
}
