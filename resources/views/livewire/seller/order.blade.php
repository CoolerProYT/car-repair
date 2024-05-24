<div>
    <div class="px-md-5 px-3 py-4">
        <div class="d-none d-md-block">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a wire:click="changeFlag('Emergency')" class="nav-link pointer {{ $flag == 'Emergency' ? 'bg-primary text-light' : 'text-dark' }}">Emergency Service</a>
                </li>
                <li class="nav-item">
                    <a wire:click="changeFlag('Product')" class="nav-link pointer {{ $flag == 'Product' ? 'bg-primary text-light' : 'text-dark' }}">Product</a>
                </li>
            </ul>
        </div>
        <div class="d-md-none">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a wire:click="changeFlag('Emergency')" class="nav-link pointer {{ $flag == 'Emergency' ? 'bg-primary text-light' : 'text-dark' }}">E.Service</a>
                </li>
                <li class="nav-item">
                    <a wire:click="changeFlag('Product')" class="nav-link pointer {{ $flag == 'Product' ? 'bg-primary text-light' : 'text-dark' }}">Product</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="px-md-5 px-3">
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a wire:click="changeStatus('Pending')" class="nav-link pointer {{ $status == 'Pending' ? 'bg-info text-light' : 'text-dark' }}">Pending</a>
                </li>
                @if($flag == 'Emergency')
                    <li class="nav-item">
                        <a wire:click="changeStatus('On The Way')" class="nav-link pointer {{ $status == 'On The Way' ? 'bg-info text-light' : 'text-dark' }}">On The Way</a>
                    </li>
                @elseif($flag == 'Product')
                    <li class="nav-item">
                        <a wire:click="changeStatus('Processing')" class="nav-link pointer {{ $status == 'Processing' ? 'bg-info text-light' : 'text-dark' }}">Processing</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a wire:click="changeStatus('Completed')" class="nav-link pointer {{ $status == 'Completed' ? 'bg-info text-light' : 'text-dark' }}">Completed</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="px-md-5 px-3 d-none d-md-block">
        @foreach($orders as $order)
            @if($flag == 'Emergency')
                @php
                    $emergency_id = $order->emergency_id;
                    $emergency = \App\Models\Emergency::find($emergency_id);
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $image = $disk->url($emergency->image);

                    $user_id = $order->user_id;
                    $user = \App\Models\User::find($user_id);
                @endphp
                <div class="my-3 py-2 bg-white">
                    <div class="px-3 border-bottom d-flex justify-content-between align-items-center">
                        <b>Order ID: {{ $order->order_id }}</b>
                        <span><b>Status:</b> {{ $order->status }}</span>
                    </div>
                    <div class="d-flex col-12 mt-2 px-3">
                        <div class="image-box" style="border-radius: unset">
                            <img src="{{ $image }}" alt="">
                        </div>
                        <div class="ms-3 d-flex flex-column justify-content-between border-end pe-3 col-3">
                            <div>
                                <div>
                                    <span class="h3 truncate">{{ $emergency->name }}</span>
                                </div>
                                <div>
                                    <span><b>Deposit:</b> RM{{ number_format($order->total_payment,2) }}</span>
                                </div>
                            </div>
                            <div>
                                <span><b>Order Time:</b> {{ $order->created_at }}</span>
                            </div>
                        </div>
                        <div class="px-3 border-end col-4">
                            <div>
                                <span><b>Buyer Location:</b> {{ $order->location }}</span>
                            </div>
                            <div>
                                <span><b>Waze: </b> <a class="text-primary" href="https://waze.com/ul?ll={{ $order->latitude }},{{ $order->longitude }}&navigate=yes" target="_blank">Get waze direction</a></span>
                            </div>
                            <div>
                                <span><b>Google Map: </b> <a class="text-primary" href="https://www.google.com/maps/search/?api=1&query={{ $order->latitude }},{{ $order->longitude }}" target="_blank">Get google map direction</a></span>
                            </div>
                        </div>
                        <div class="px-3 d-flex flex-column justify-content-between border-end col-2">
                            <div>
                                <div>
                                    <span><b>Buyer:</b> {{ $user->username }}</span>
                                </div>
                                <div>
                                    <span><b>Phone:</b> +6{{ $user->phone_number }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('seller.chat',['user_id' => $user_id]) }}" target="_blank" class="btn btn-dark">Contact Buyer</a>
                            </div>
                        </div>
                        <div class="ps-3 d-flex col-2 justify-content-center align-items-center">
                            @if($order->status == 'Pending')
                                <button wire:click="updateOrderStatus('On The Way','{{ $order->id }}')" class="btn btn-success">Go Now</button>
                            @elseif($order->status == 'On The Way')
                                <button wire:click="updateOrderStatus('Completed','{{ $order->id }}')" class="btn btn-success">Complete</button>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif($flag == 'Product')
                @php
                    $product_id = $order->product_id;
                    $product = \App\Models\Product::find($product_id);
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $image = $disk->url($product->image);

                    $user_id = $order->user_id;
                    $user = \App\Models\User::find($user_id);
                @endphp
                <div class="my-3 py-2 bg-white">
                    <div class="px-3 border-bottom d-flex justify-content-between align-items-center">
                        <b>Order ID: {{ $order->order_id }}</b>
                        <span><b>Status:</b> {{ $order->status }}</span>
                    </div>
                    <div class="d-flex col-12 mt-2 px-3">
                        <div class="image-box" style="border-radius: unset">
                            <img src="{{ $image }}" alt="">
                        </div>
                        <div class="ms-3 d-flex flex-column justify-content-between border-end pe-3 col-3">
                            <div>
                                <div>
                                    <span class="h3 truncate">{{ $product->name }}</span>
                                </div>
                                <div>
                                    <span><b>Deposit:</b> RM{{ number_format($order->total_payment,2) }}</span>
                                </div>
                                <div>
                                    <span><b>Quantity:</b> RM{{ $order->quantity }}</span>
                                </div>
                            </div>
                            <div>
                                <span><b>Order Time:</b> {{ $order->created_at }}</span>
                            </div>
                        </div>
                        <div class="px-3 border-end col-4">
                            <div>
                                <span>Process after buyer has arrived your store.</span>
                            </div>
                        </div>
                        <div class="px-3 d-flex flex-column justify-content-between border-end col-2">
                            <div>
                                <div>
                                    <span><b>Buyer:</b> {{ $user->username }}</span>
                                </div>
                                <div>
                                    <span><b>Phone:</b> +6{{ $user->phone_number }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('seller.chat',['user_id' => $user_id]) }}" target="_blank" class="btn btn-dark">Contact Buyer</a>
                            </div>
                        </div>
                        <div class="ps-3 d-flex col-2 justify-content-center align-items-center">
                            @if($order->status == 'Pending')
                                <button wire:click="updateOrderStatus('Processing','{{ $order->id }}')" class="btn btn-success">Process</button>
                            @elseif($order->status == 'On The Way' || $order->status == 'Processing')
                                <button wire:click="updateOrderStatus('Completed','{{ $order->id }}')" class="btn btn-success">Complete</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="px-md-5 px-3 d-md-none">
        @foreach($orders as $order)
            @if($flag == 'Emergency')
                @php
                    $emergency_id = $order->emergency_id;
                    $emergency = \App\Models\Emergency::find($emergency_id);
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $image = $disk->url($emergency->image);

                    $user_id = $order->user_id;
                    $user = \App\Models\User::find($user_id);
                @endphp
                <div class="my-3 py-2 bg-white">
                    <div class="px-3 border-bottom">
                        <div>
                            <b>Order ID: {{ $order->order_id }}</b>
                        </div>
                        <div>
                            <span><b>Status:</b> {{ $order->status }}</span>
                        </div>
                    </div>
                    <div class="col-12 mt-2 px-2">
                        <div class="d-flex">
                            <div class="image-box" style="border-radius: unset">
                                <img src="{{ $image }}" alt="">
                            </div>
                            <div class="ms-3 col-7">
                                <div>
                                    <div>
                                        <span class="h3 truncate">{{ $emergency->name }}</span>
                                    </div>
                                    <div>
                                        <span><b>Deposit:</b> RM{{ number_format($order->total_payment,2) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span><b>Order Time:</b> {{ $order->created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 border-top border-bottom">
                            <div>
                                <span><b>Buyer Location:</b> {{ $order->location }}</span>
                            </div>
                            <div>
                                <span><b>Waze: </b> <a class="text-primary" href="https://waze.com/ul?ll={{ $order->latitude }},{{ $order->longitude }}&navigate=yes" target="_blank">Get waze direction</a></span>
                            </div>
                            <div>
                                <span><b>Google Map: </b> <a class="text-primary" href="https://www.google.com/maps/search/?api=1&query={{ $order->latitude }},{{ $order->longitude }}" target="_blank">Get google map direction</a></span>
                            </div>
                        </div>
                        <div class="px-2">
                            <div>
                                <div>
                                    <span><b>Buyer:</b> {{ $user->username }}</span>
                                </div>
                                <div>
                                    <span><b>Phone:</b> +6{{ $user->phone_number }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('seller.chat',['user_id' => $user_id]) }}" target="_blank" class="btn btn-dark">Contact Buyer</a>
                            </div>
                        </div>
                        <div class="px-2 mt-2">
                            @if($order->status == 'Pending')
                                <button wire:click="updateOrderStatus('On The Way','{{ $order->id }}')" class="btn btn-success col-12">Go Now</button>
                            @elseif($order->status == 'On The Way')
                                <button wire:click="updateOrderStatus('Completed','{{ $order->id }}')" class="btn btn-success col-12">Complete</button>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif($flag == 'Product')
                @php
                    $product_id = $order->product_id;
                    $product = \App\Models\Product::find($product_id);
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $image = $disk->url($product->image);

                    $user_id = $order->user_id;
                    $user = \App\Models\User::find($user_id);
                @endphp
                <div class="my-3 py-2 bg-white">
                    <div class="px-3 border-bottom">
                        <b>Order ID: {{ $order->order_id }}</b>
                        <span><b>Status:</b> {{ $order->status }}</span>
                    </div>
                    <div class="col-12 mt-2 px-2">
                        <div class="d-flex">
                            <div class="image-box" style="border-radius: unset">
                                <img src="{{ $image }}" alt="">
                            </div>
                            <div class="ms-3 col-7">
                                <div>
                                    <div>
                                        <span class="h3 truncate">{{ $product->name }}</span>
                                    </div>
                                    <div>
                                        <span><b>Deposit:</b> RM{{ number_format($order->total_payment,2) }}</span>
                                    </div>
                                    <div>
                                        <span><b>Quantity:</b> RM{{ $order->quantity }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span><b>Order Time:</b> {{ $order->created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 border-top border-bottom">
                            <div>
                                <span>Process after buyer has arrived your store.</span>
                            </div>
                        </div>
                        <div class="px-2">
                            <div>
                                <div>
                                    <span><b>Buyer:</b> {{ $user->username }}</span>
                                </div>
                                <div>
                                    <span><b>Phone:</b> +6{{ $user->phone_number }}</span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('seller.chat',['user_id' => $user_id]) }}" target="_blank" class="btn btn-dark">Contact Buyer</a>
                            </div>
                        </div>
                        <div class="px-2 mt-2">
                            @if($order->status == 'Pending')
                                <button wire:click="updateOrderStatus('Processing','{{ $order->id }}')" class="btn btn-success col-12">Process</button>
                            @elseif($order->status == 'On The Way' || $order->status == 'Processing')
                                <button wire:click="updateOrderStatus('Completed','{{ $order->id }}')" class="btn btn-success col-12">Complete</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
