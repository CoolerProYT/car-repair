@extends('seller.layout.auth_master')
@section('title','Register')

@section('content')
    <div class="bg-dark-gray" style="min-height: 100vh">
        <div class="container d-flex align-items-center auth-body py-5">
            @livewire('seller.register')
        </div>
    </div>
@endsection
