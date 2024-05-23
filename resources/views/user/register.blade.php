@extends('user.layout.master')
@section('title', 'Register')

@section('content')
    <div class="container d-flex align-items-center auth-body mt-5">
        @livewire('user.register')
    </div>
@endsection
