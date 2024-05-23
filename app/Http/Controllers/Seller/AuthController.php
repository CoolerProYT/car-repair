<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return redirect()->route('seller.login');
    }

    public function login()
    {
        if(auth('seller')->check()){
            return redirect()->route('seller.dashboard');
        }

        return view('seller.login');
    }

    public function register(){
        if(auth('seller')->check()){
            return redirect()->route('seller.dashboard');
        }

        return view('seller.register');
    }

    public function logout(){
        auth('seller')->logout();
        return redirect()->route('seller.login');
    }

    public function resetPassword(){
        return view('seller.reset_password');
    }
}
