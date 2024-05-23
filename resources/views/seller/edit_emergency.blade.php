@extends('seller.layout.master')
@section('title','Edit Emergency Service')

@section('content')
    @livewire('seller.edit-emergency',['id' => $id])
@endsection
