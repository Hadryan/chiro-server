<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['name', 'customer_id', 'city_id', 'lat', 'lng', 'address', 'icon_id'];

    public $timestamps =  false;

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'icon_id' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\Customer');
    }

    public function city()
    {
        return $this->hasOne('App\Model\City');
    }
}
