<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        if(auth()->guard('user')->check()){
            return redirect(route('user.home'));
        }

        if($request->query('redirect')){
            return view('user.login', ['redirect' => urldecode($request->query('redirect'))]);
        }

        return view('user.login',['redirect' => route('user.home')]);
    }

    public function register(){
        if(auth()->guard('user')->check()){
            return redirect(route('user.home'));
        }

        return view('user.register');
    }

    public function logout(){
        auth()->guard('user')->logout();
        return redirect(route('user.login'));
    }

    public function resetPassword(){
        if(auth()->guard('user')->check()){
            return redirect(route('user.home'));
        }

        return view('user.reset_password');
    }
}
