<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings()
    {
        return redirect()->route('seller.settings.account');
    }

    public function account(){
        return view('seller.account');
    }

    public function shop(){
        return view('seller.shop');
    }
}
