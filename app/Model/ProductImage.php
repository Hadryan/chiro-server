<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['id', 'path', 'product_id'];

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

    public function getPathAttribute()
    {
        return @$this->attributes['path'] ? url('storage/' . $this->attributes['path']) : '';
    }

    public function products()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
