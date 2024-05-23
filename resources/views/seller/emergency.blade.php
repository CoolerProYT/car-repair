@extends('seller.layout.master')
@section('title','Emergency Service')

@section('content')
    @include('seller.layout.emergency')
    @livewire('seller.emergency')
@endsection
