@extends('seller.layout.master')
@section('title','Product')

@section('content')
    @include('seller.layout.product')
    @livewire('seller.product')
@endsection
