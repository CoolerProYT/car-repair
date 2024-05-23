@extends('seller.layout.auth_master')
@section('title','Register')

@section('content')
    <div class="container d-flex align-items-center auth-body mt-5">
        @livewire('seller.register')
    </div>
@endsection
