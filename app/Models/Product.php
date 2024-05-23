<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'description',
        'image',
        'category',
        'price_from',
        'price_to',
        'deposit',
        'approved',
    ];

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
