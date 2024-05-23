<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat($user_id){
        if($user_id != 'none'){
            if(!User::where('id',$user_id)->exists()){
                return redirect()->route('seller.dashboard');
            }

            if(!ChatRoom::where('seller_id',auth()->guard('seller')->user()->id)->where('user_id',$user_id)->exists()){
                ChatRoom::create([
                    'seller_id' => auth()->guard('seller')->user()->id,
                    'user_id' => $user_id
                ]);
            }

            $chat_room = ChatRoom::where('seller_id',auth()->guard('seller')->user()->id)->where('user_id',$user_id)->first()->id;

            return view('seller.chat',['chat_room_id' => $chat_room]);
        }

        return view('seller.chat',['chat_room_id' => 'none']);
    }
}
