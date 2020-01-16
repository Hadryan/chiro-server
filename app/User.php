<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends \TCG\Voyager\Models\User
{
    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
