@extends('seller.layout.auth_master')
@section('title','Login')

@section('content')
    <div class="bg-dark-gray">
        <div class="container d-flex align-items-center auth-body py-5" style="min-height: 100vh">
            @livewire('seller.login')
        </div>
    </div>
@endsection
