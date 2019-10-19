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


        if ($request->has('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
        }

        $product = app('products')->insert($request->all(), @$imagePath);

        return $this->respond($product, 201);
    }

    public function search(Request $request)
    {

        $search = $request->input('query');

        $search = explode(' ', $search);

        $result = app('products')->search($search);

        return $this->respond($result);
    }
}
