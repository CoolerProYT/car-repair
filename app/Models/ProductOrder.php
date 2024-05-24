<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'seller_id',
        'order_id',
        'tran_id',
        'quantity',
        'total_payment',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
