@extends('seller.layout.auth_master')
@section('title','Reset Password')

@section('content')
    <div class="bg-dark-gray" style="min-height: 100vh">
        <div class="container d-flex align-items-center auth-body pt-5">
            @livewire('seller.reset-password')
        </div>
    </div>
@endsection
