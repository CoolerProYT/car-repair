@extends('user.layout.master')
@section('title', 'Reset Password')

@section('content')
    <div class="bg-dark-gray">
        <div class="container d-flex align-items-center auth-body py-5">
            @livewire('user.reset-password')
        </div>
    </div>
@endsection
