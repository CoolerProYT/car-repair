@extends('user.layout.master')
@section('title', 'Reset Password')

@section('content')
    <div class="container d-flex align-items-center auth-body mt-5">
        @livewire('user.reset-password')
    </div>
@endsection
