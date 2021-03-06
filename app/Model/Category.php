<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'description', 'image_path', 'type'];

    public function getImagePathAttribute()
    {
        return @$this->attributes['image_path'] ? url('storage' . $this->attributes['image_path']) : '';
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product');
    }
}
