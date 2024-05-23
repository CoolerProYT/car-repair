@extends('seller.layout.master')
@section('title','Edit Product')

@section('content')
    @livewire('seller.edit-product',['id' => $id])
@endsection
