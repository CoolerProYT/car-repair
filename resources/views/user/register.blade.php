@extends('user.layout.master')
@section('title', 'Register')

@section('content')
    <div class="bg-dark-gray">
        <div class="container d-flex align-items-center auth-body py-5">
            @livewire('user.register')
        </div>
    </div>
@endsection
