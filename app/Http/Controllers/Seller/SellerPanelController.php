<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerPanelController extends Controller
{
    public function dashboard()
    {
        return view('seller.dashboard');
    }
}
