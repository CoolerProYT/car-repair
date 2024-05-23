<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
        'profile_image',
        'verification_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
