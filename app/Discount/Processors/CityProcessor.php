<?php

namespace App\Discount\Processors;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityProcessor implements Processor
{
    public function process(Order $order): bool
    {
        $address = $order->shippingAddress;
        try {
            $discount = Discount::where([
                'on' => 'city',
                'target_id' => $address->city_id
            ])->firstOrFail();

            if ($discount->lower_limit != null && $order->totalPrice < $discount->lower_limit) {
                return false;
            }
            $order->addDiscount($discount);
        } catch (ModelNotFoundException $ignored) {
            return false;
        }
        return false;
    }
}
