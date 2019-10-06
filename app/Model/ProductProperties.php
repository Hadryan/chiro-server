<?php

namespace App\Model;

use Illuminate\Support\Collection;

/**
 * @property string $size
 * @property string $color
 */
class ProductProperties extends Collection
{
    public function __get($key)
    {
        if ($this->has($key)) {
            return $this->get($key);
        }
        throw new \RunntimeException("invalid property $key");
    }
}
