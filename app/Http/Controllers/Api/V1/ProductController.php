<?php

namespace App\Http\Controllers\Api\V1;

use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Api\Controller;
use App\Model\Favorite;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['categories'])->paginate();
        return $this->respond($products->items());
    }

    public function single($id)
    {
        $product = app('products')->get($id)->toArray();

        if (!auth('api')->guest()) {
            $customerId = auth('api')->id();
            $product['is_favorite'] = Favorite::where([
                'product_id' => $product['id'],
                'customer_id' => $customerId,
            ])->exists();
        }

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

    public function productsByCategory($categoryId)
    {
        $products = Product::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->paginate();

        return $this->respond($products);
    }
}
