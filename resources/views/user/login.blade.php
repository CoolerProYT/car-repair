@extends('user.layout.master')
@section('title', 'Login')

@section('content')
    <div class="container d-flex align-items-center auth-body mt-5">
        @livewire('user.login',['redirect' => $redirect])
    </div>
@endsection
