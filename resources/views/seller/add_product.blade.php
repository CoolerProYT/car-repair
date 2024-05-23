@extends('seller.layout.master')
@section('title','Add Product')

@section('content')
    @include('seller.layout.product')
    @livewire('seller.add-product')
@endsection
