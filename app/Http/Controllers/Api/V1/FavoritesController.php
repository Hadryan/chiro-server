<?php

namespace App\Http\Controllers\Api\V1;

use App\Model\Product;
use App\Model\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FavoritesController extends Controller
{
    public function index()
    {
        $customerId = auth('api')->id();

        $products = \DB::table('products')
            ->join('favorites', 'products.id', '=', 'favorites.product_id')
            ->where('favorites.customer_id', $customerId)
            ->paginate();
        return $this->respond($products);
    }

    public function add(Request $request)
    {
        $data = $this->validate($request, [
            'product_id' => 'required|numeric'
        ]);

        $customerId = auth('api')->id();

        if (null != Favorite::where([
            'product_id' => $data['product_id'],
            'customer_id' => $customerId,
        ])->first()) {
            throw new HttpException(409, __('fav.item_already_exists'));
        }

        Product::findOrFail($data['product_id']);

        Favorite::create([
            'product_id' => $data['product_id'],
            'customer_id' => $customerId
        ]);

        return $this->respond(null, 201);
    }

    public function remove(Request $request, int $productId)
    {

        $customerId = auth('api')->id();

        $fav = Favorite::where([
            'product_id' => $productId,
            'customer_id' => $customerId,
        ])->firstOrFail();

        \DB::table('favorites')->where([
            'product_id' => $productId,
            'customer_id' => $customerId
        ])->delete();

        return $this->respond();
    }
}
