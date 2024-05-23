<div class="container d-flex mt-5 bg-white px-0 shadow chat-box col-12">
    <div class="col-3 border-end" id="chat-room">
        @foreach($chat_rooms as $chatroom)
            <div onclick="location.href='{{ route('user.chat',['seller_id' => $chatroom->seller_id]) }}'" class="border-bottom pointer d-flex py-2 px-2 {{ $chat_room_id == $chatroom->id ? 'bg-light' : '' }}">
                <div class="chat-image-box border" wire:ignore>
                    <img src="{{ $chatroom->image }}" alt="">
                </div>
                <div class="ms-3 d-flex flex-column justify-content-between">
                    <div>
                        <div wire:ignore>
                            <span class="h5">{{ $chatroom->name }}</span>
                        </div>
                        <div>
                            <span class="truncate" style="font-size: 14px">{{ $chatroom->last_message }}</span>
                        </div>
                    </div>
                    <div>
                        <span style="font-size: 10px">{{ $chatroom->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-9 d-flex flex-column justify-content-between {{ $chat_room_id == 'none' ? 'd-none' : '' }}" style="position: relative">
        <div>
            <div class="chat-header p-3 bg-light shadow-sm">
                <span class="h3">{{ $seller_name }}</span>
            </div>
            <div id="chat-history">
                @foreach($chat_histories as $chat_history)
                    @if($chat_history->sender_type == 'user')
                        @if($chat_history->content_type == 'text')
                            <div class="d-flex flex-row-reverse align-items-center my-2">
                                <div class="chat-history-image-box border ms-3">
                                    <img src="{{ $user_image }}" alt="">
                                </div>
                                <div class="bg-light shadow-sm p-2" style="max-width: 50%">
                                    <span>{{ $chat_history->content }}</span>
                                </div>
                            </div>
                        @else
                            @php
                                $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                                $url = $disk->url($chat_history->content);
                            @endphp
                            <div class="d-flex flex-row-reverse align-items-center my-2">
                                <div class="chat-history-image-box border ms-3">
                                    <img src="{{ $user_image }}" alt="">
                                </div>
                                <div class="bg-light shadow-sm p-2" style="max-width: 50%">
                                    <img src="{{ $url }}" style="max-width: 100%;">
                                </div>
                            </div>
                        @endif
                    @else
                        @if($chat_history->content_type == 'text')
                            <div class="d-flex align-items-center my-2">
                                <div class="chat-history-image-box border ms-3">
                                    <img src="{{ $seller_image }}" alt="">
                                </div>
                                <div class="bg-light shadow-sm p-2 ms-3" style="max-width: 50%">
                                    <span>{{ $chat_history->content }}</span>
                                </div>
                            </div>
                        @else
                            @php
                                $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                                $url = $disk->url($chat_history->content);
                            @endphp
                            <div class="d-flex align-items-center my-2">
                                <div class="chat-history-image-box border ms-3">
                                    <img src="{{ $seller_image }}" alt="">
                                </div>
                                <div class="bg-light shadow-sm p-2 ms-3" style="max-width: 50%">
                                    <img src="{{ $url }}" style="max-width: 100%;">
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        <form class="chat-input-area bg-light col-12 p-3 d-flex shadow-sm align-items-center" wire:submit.prevent="sendMessage">
            <input type="file" class="d-none" id="image" wire:model="image">
            <label for="image" class="pointer me-3 bg-white border shadow-sm p-1">
                <img src="{{ $image == '' ? asset('icon/file.svg') : asset('icon/image.svg') }}">
            </label>
            <input type="text" class="form-control" wire:model="message" {{ $image == '' ? '' : 'disabled' }}>
            <button class="ms-3 btn btn-primary">Send</button>
        </form>
    </div>
    <script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
    <script>
        var pusher = new Pusher("9a2782ac68d6aed614ed", {
            cluster: "ap1",
        });

        var channel = pusher.subscribe("chat{{ $chat_room_id }}");

        channel.bind("message-sent", (data) => {
            @this.call('load');
            setTimeout(() => {
                $("#chat-history").scrollTop($("#chat-history")[0].scrollHeight);
            }, 500);
        });

        $("#chat-history").scrollTop($("#chat-history")[0].scrollHeight);
    </script>
</div>
