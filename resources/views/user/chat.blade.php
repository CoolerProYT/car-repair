@extends('user.layout.master')
@section('title', 'Chat')

@section('content')
    @livewire('user.chat',['chat_room_id' => $chat_room_id])
@endsection
