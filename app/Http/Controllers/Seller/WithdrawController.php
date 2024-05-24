<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function withdraw(){
        return view('seller.withdraw');
    }
}
