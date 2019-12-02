<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['code', 'type', 'on', 'target_id', 'lower_limit', 'amount', 'exclusive'];
}
