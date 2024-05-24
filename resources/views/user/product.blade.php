@extends('user.layout.master')
@section('title', 'Products')

@section('content')
    @livewire('user.product',['category' => $category, 'search' => $search])
@endsection
