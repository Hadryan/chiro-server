<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'customer_id', 'gateway_id', 'status', 'ref_code'];
}
