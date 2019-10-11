<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property integer $discount
 * @property \App\Model\ProductProperties $properties
 */
class Product extends Model
{
    protected $fillable = ['name', 'description', 'properties', 'price', 'discount'];

    public function getPropertiesAttribute()
    {
        $data = json_decode($this->attributes['properties'], true);
        return new ProductProperties($data);
    }

    public function setPropertiesAttribute($properties)
    {
        $this->attributes['properties'] = $properties->toJson();
    }
    public function image()
    {
        return $this->hasOne('App\Model\ProductImage')->select(['product_id', 'path']);
    }
    public function images()
    {
        return $this->hasMany('App\Model\ProductImage')->select(['product_id', 'path']);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category');
    }
}