<?php

namespace App\Model;

use App\Model\Discount;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @property int $user_id
 * @property int $address_id
 * @property Collection $products
 */
class Order extends Model
{

    use SoftDeletes;

    protected $fillable = ['customer_id', 'address_id'];
    protected $dates = ['deleted_at'];

    /**
     * @return HasManyThrough
     */
    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'App\Model\OrderProduct')->withPivot('quantity', 'unit_price');
    }

    public function shippingAddress()
    {
        return $this->hasOne('App\Model\ShippingAddress');
    }

    public function addDiscount(Discount $discount)
    {
    }
}
