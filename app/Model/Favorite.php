<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    protected $primaryKey = null;

    public $incrementing = false;

    protected $fillable = ['product_id', 'customer_id'];

    public $timestamps = false;

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
