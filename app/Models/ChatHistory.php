<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    use HasFactory;

    protected $fillable = ['chat_room_id', 'content', 'content_type', 'sender_type'];

    public function chatRoom(){
        return $this->belongsTo(ChatRoom::class);
    }
}
