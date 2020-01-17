<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property string $size
 * @property string $color
 */
class ProductProperties extends Model
{
    protected $fillable = ['slug', 'name_en', 'name_fa', 'value'];

    public $timestamps = false;
}
