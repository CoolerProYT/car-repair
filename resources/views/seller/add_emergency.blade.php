@extends('seller.layout.master')
@section('title','Add Emergency Service')

@section('content')
    @include('seller.layout.emergency')
    @livewire('seller.add-emergency')
@endsection
