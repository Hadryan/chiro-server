<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['name', 'customer_id', 'city_id', 'lat', 'lng', 'address'];

    public $timestamps =  false;

    public function user()
    {
        return $this->belongsTo('App\Model\Customer');
    }

    public function city()
    {
        return $this->hasOne('App\Model\City');
    }
}
