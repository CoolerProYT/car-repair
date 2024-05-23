<?php

namespace App\Livewire\User;

use App\Models\ChatHistory;
use App\Models\ChatRoom;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Pusher\Pusher;

class Chat extends Component
{
    use WithFileUploads;

    public $chat_room_id;
    public $chat_histories;
    public $chat_rooms;
    public $seller_name;
    public $seller_image;
    public $user_image;

    public $message;
    public $image;

    public function mount(){
        $this->load();
    }

    public function sendMessage(){
        if($this->image){
            $this->validate([
                'image' => 'image|max:4096'
            ]);

            $filePath = $this->image->getRealPath();
            $fileName = Str::random(40) . '.' . $this->image->getClientOriginalExtension();

            $disk = Storage::disk('gcs');
            $disk->put('chat/' . $fileName, fopen($filePath, 'r'), [
                'visibility' => 'public',
            ]);

            ChatHistory::create([
                'chat_room_id' => $this->chat_room_id,
                'content' => 'chat/' . $fileName,
                'content_type' => 'image',
                'sender_type' => 'user'
            ]);

            ChatRoom::find($this->chat_room_id)->update([
                'last_message' => '[image]'
            ]);
        }
        else{
            $this->validate([
                'message' => 'required'
            ]);

            ChatHistory::create([
                'chat_room_id' => $this->chat_room_id,
                'content' => $this->message,
                'content_type' => 'text',
                'sender_type' => 'user'
            ]);

            ChatRoom::find($this->chat_room_id)->update([
                'last_message' => $this->message
            ]);
        }

        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), array('cluster' => env('PUSHER_APP_CLUSTER')));
        $pusher->trigger("chat$this->chat_room_id", 'message-sent', array('message' => $this->message));

        $this->message = '';
        $this->image = '';
    }

    public function load(){
        $this->chat_histories = ChatHistory::where('chat_room_id',$this->chat_room_id)->get();
        $chat_rooms = ChatRoom::where('user_id', Auth::guard('user')->user()->id)->orderBy('updated_at','desc')->get();

        $disk = Storage::disk('gcs');

        foreach($chat_rooms as $chatroom){
            $seller_id = $chatroom->seller_id;
            $seller = Seller::find($seller_id);
            $image = $seller->profile_image;
            $image = $disk->url($image);
            $chatroom->image = $image;
            $chatroom->name = $seller->username;
        }

        $this->chat_rooms = $chat_rooms;

        if($this->chat_room_id != 'none'){
            $seller_id = ChatRoom::find($this->chat_room_id)->seller_id;
            $seller = Seller::find($seller_id);
            $this->seller_name = $seller->username;
            $this->seller_image = $disk->url($seller->profile_image);
            $this->user_image = $disk->url(Auth::guard('user')->user()->profile_image);
        }
    }

    public function render()
    {
        return view('livewire.user.chat');
    }
}
