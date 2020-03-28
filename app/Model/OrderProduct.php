<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $primaryKey = null;
    protected $fillable = ['order_id', 'product_id', 'quantity', 'unit_price'];
    public $timestamps = false;
}
