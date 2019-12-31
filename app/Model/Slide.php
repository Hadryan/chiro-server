<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['title', 'alt', 'target_url', 'image_url'];
}
