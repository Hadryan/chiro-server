<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Pending()
 * @method static static Failed()
 * @method static static Canceled()
 * @method static static Successful()
 */
final class PaymentStatus extends Enum
{
    const Pending       = 0;
    const Failed        = 1;
    const Canceled      = 2;
    const Successful    = 3;
}
