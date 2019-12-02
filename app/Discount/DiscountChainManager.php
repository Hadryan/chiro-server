<?php

namespace App\Discount;

use App\Discount\Processors\CityProcessor;
use App\Model\Order;

class DiscountChainManager
{
    private $processors = [
        CityProcessor::class,
    ];

    public function apply(Order $order)
    {
        foreach ($this->processors as $class) {
            $processor = new $class;
            if ($processor->process($order)) {
                return;
            }
        }
    }
}
