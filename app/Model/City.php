<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = ['name', 'parent_id', 'area'];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo('App\Model\City', 'parent_id');
    }
}
