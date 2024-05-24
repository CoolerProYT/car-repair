@extends('user.layout.master')
@section('title', 'Products')

@section('content')
    @livewire('user.product-detail',['id' => $id])
@endsection
