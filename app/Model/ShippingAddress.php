<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['name', 'user_id', 'city_id', 'location', 'address'];

    public $timestamps =  false;

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function city()
    {
        return $this->hasOne('App\Model\City');
    }
}
