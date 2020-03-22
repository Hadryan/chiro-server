<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


/**
 * @method static static Pending()
 * @method static static Processing()
 * @method static static InShippment()
 * @method static static Shipped()
 * @method static static Canceled()
 * @method static static Refunded()
 * @method static static NeedModeration()
 */
final class OrderStatus extends Enum
{
    const Pending = 0;
    const Processing = 1;
    const InShippment = 2;
    const Shipped = 3;
    const Canceled = 4;
    const Refunded = 5;
    const NeedModeration = 6;
}
