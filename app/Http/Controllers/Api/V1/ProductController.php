<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller;
use App\Model\Product;
use App\Model\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


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
            'discount' => 'numeric',
            'image' => [Rule::dimensions()->maxWidth(500)->maxHeight(500)->minHeight(100)->minWidth(100)]
        ]);

        $product = Product::create($request->all());

        if ($request->has('image')) {
            $image = $request->file('image')->store('images/products', 'public');

            $productImage = ProductImage::create([
                'path' => $image
            ]);

            $product->images()->save($productImage);
        }

        return $this->respond($product, 201);
    }
}
