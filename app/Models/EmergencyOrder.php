<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'user_id',
        'emergency_id',
        'order_id',
        'tran_id',
        'location',
        'latitude',
        'longitude',
        'total_payment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
