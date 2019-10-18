<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['path'];

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

    public function getPathAttribute()
    {
        return url($this->attributes['path']);
    }

    public function products()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
