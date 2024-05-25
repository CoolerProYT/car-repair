@extends('seller.layout.master')
@section('title','Settings')

@section('content')
    <div class="px-md-5 px-3 py-4">
        <div class="d-none d-md-block">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="{{ route('seller.settings.account') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.settings.account' ? 'bg-primary text-light' : 'text-dark' }}">Account Settings</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.settings.shop') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.settings.shop' ? 'bg-primary text-light' : 'text-dark' }}">Shop Settings</a>
                </li>
            </ul>
        </div>
        <div class="d-md-none">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="{{ route('seller.settings.account') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.settings.account' ? 'bg-primary text-light' : 'text-dark' }}">Account</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('seller.settings.shop') }}" class="nav-link pointer {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'seller.settings.shop' ? 'bg-primary text-light' : 'text-dark' }}">Shop</a>
                </li>
            </ul>
        </div>
    </div>
    @yield('settings')
@endsection
