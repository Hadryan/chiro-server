<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingTime extends Model
{
    protected $fillable = ['starting_hour', 'ending_hour'];

    public $timestamps = false;
}
