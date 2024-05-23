@extends('user.layout.master')
@section('title', 'Emergency Services')

@section('content')
    @livewire('user.emergency-detail',['id' => $id])
@endsection
