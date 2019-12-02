<?php

namespace App\Discount\Processors;

use App\Model\Order;

interface Processor
{
    public function process(Order $order): bool;
}
