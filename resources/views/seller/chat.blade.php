@extends('seller.layout.master')
@section('title','Chat')

@section('content')
    @livewire('seller.chat',['chat_room_id' => $chat_room_id])
@endsection
