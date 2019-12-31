<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'description', 'image_path', 'type'];

    public function getImagePathAttribute()
    {
        return url($this->attributes['image_path']);
    }
}
