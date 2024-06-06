<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'amount',
        'bank_name',
        'account_name',
        'account_number',
        'status',
        'pdf'
    ];

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
