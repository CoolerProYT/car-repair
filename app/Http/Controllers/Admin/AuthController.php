<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.login');
    }

    public function login()
    {
        if(auth('admin')->check()){
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
}
