<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\Seller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat($seller_id){
        if($seller_id != 'none'){
            if(!Seller::where('id',$seller_id)->exists()){
                return redirect()->route('user.home');
            }

            if(!ChatRoom::where('user_id',auth()->guard('user')->user()->id)->where('seller_id',$seller_id)->exists()){
                ChatRoom::create([
                    'user_id' => auth()->guard('user')->user()->id,
                    'seller_id' => $seller_id
                ]);
            }

            $chat_room = ChatRoom::where('user_id',auth()->guard('user')->user()->id)->where('seller_id',$seller_id)->first()->id;

            return view('user.chat',['chat_room_id' => $chat_room]);
        }

        return view('user.chat',['chat_room_id' => 'none']);
    }
}
