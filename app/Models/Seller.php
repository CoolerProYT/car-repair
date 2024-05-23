<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;

class Seller extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
        'store_name',
        'profile_image',
        'phone_number',
        'store_address',
        'store_latitude',
        'store_longitude',
        'verification_code',
        'open_time',
        'close_time',
        'balance',
        'state',
        'area',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function emergencies()
    {
        return $this->hasMany(Emergency::class);
    }

    public function chatRooms(){
        return $this->hasMany(ChatRoom::class);
    }
}
