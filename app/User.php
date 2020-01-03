<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends \TCG\Voyager\Models\User
{
    protected $fillable = ['name', 'email', 'password'];
}
