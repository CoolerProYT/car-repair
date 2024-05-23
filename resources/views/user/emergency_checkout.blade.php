@extends('user.layout.master')
@section('title', 'Checkout Emergency Services')

@section('content')
    @livewire('user.emergency-checkout',['id' => $id])
@endsection
