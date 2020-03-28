<?php

namespace App\Http\Controllers\Api\V1;

use App\Model\Order;
use App\Model\Product;
use App\Model\OrderProduct;
use Illuminate\Http\Request;
use App\Model\ShippingAddress;
use App\Http\Controllers\Api\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'address_id' => 'required|numeric',
            'time_id' => 'required|numeric',
            'products' => 'required'
        ]);

        $customerId = auth('api')->id();

        $shippingAddress = ShippingAddress::findOrFail($data['address_id']);

        if ($shippingAddress->customer_id != $customerId) {
            throw new HttpException(403, __('order.invalid_address_id'));
        }

        $order = Order::create([
            'customer_id' => $customerId,
            'address_id' => $data['address_id'],
            'time_id' => $data['time_id'],
        ]);

        $products = json_decode($data['products'], true);

        $idIndexedProducts = [];

        Product::whereIn('id', array_keys($products))->get()->each(function (Product $product) use (&$idIndexedProducts) {
            $idIndexedProducts[$product->id] = $product;
        });

        $orderProducts = [];

        foreach ($products as $pId => $quantity) {
            $orderProducts[] = [
                'order_id' => $order->id,
                'product_id' => $pId,
                'quantity' => $quantity,
                'unit_price' => $idIndexedProducts[$pId]->price,
            ];
        }

        OrderProduct::insert($orderProducts);

        $order = Order::with(['products'])->find($order->id);

        return $this->respond($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
