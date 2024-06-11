@extends('admin.layout.auth_master')
@section('title','Login')

@section('content')
    <div class="bg-dark-gray" style="min-height: 100vh">
        <div class="container d-flex align-items-center auth-body pt-5">
            @livewire('admin.login')
        </div>
    </div>
@endsection
