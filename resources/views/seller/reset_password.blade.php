@extends('seller.layout.auth_master')
@section('title','Reset Password')

@section('content')
    <div class="container d-flex align-items-center auth-body mt-5">
        @livewire('seller.reset-password')
    </div>
@endsection
