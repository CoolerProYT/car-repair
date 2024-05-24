@extends('user.layout.master')
@section('title', 'Checkout Product')

@section('content')
    @livewire('user.product-checkout',['id' => $id,'quantity' => $quantity])
@endsection
