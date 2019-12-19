<?php

namespace App\Discount\Processors;

use App\Model\Order;

interface ProcessorInterface
{
    public function process(Order $order): bool;
}
