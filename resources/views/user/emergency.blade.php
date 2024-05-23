@extends('user.layout.master')
@section('title', 'Emergency Services')

@section('content')
    @livewire('user.emergency',['category' => $category])
@endsection
