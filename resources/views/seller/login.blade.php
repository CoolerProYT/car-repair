@extends('seller.layout.auth_master')
@section('title','Login')

@section('content')
    <div class="container d-flex align-items-center auth-body mt-5">
        @livewire('seller.login')
    </div>
@endsection
