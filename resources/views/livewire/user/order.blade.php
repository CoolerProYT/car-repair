<div class="bg-light">
    <div class="my-5 container">
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a wire:click="updateFlag('Emergency')" class="nav-link pointer {{ $flag == 'Emergency' ? 'bg-primary text-light' : 'text-dark' }}">Emergency Service</a>
                </li>
                <li class="nav-item">
                    <a wire:click="updateFlag('Product')" class="nav-link pointer {{ $flag == 'Product' ? 'bg-primary text-light' : 'text-dark' }}">Product</a>
                </li>
            </ul>
        </div>
        <div class="d-none d-md-block">
            @foreach($orders as $order)
                @if($flag == 'Emergency')
                    @php
                        $emergency_id = $order->emergency_id;
                        $emegency = \App\Models\Emergency::find($emergency_id);
                        $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                        $image = $disk->url($emegency->image);

                        $seller_id = $emegency->seller_id;
                        $seller = \App\Models\Seller::find($seller_id);
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
                            <div class="ms-3 d-flex flex-column justify-content-between border-end pe-3">
                                <div>
                                    <div>
                                        <span class="h3 truncate">{{ $emegency->name }}</span>
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
                                    <span><b>Your Location:</b> {{ $order->location }}</span>
                                </div>
                            </div>
                            <div class="ps-3 d-flex flex-column justify-content-between">
                                <div>
                                    <div>
                                        <span><b>Seller:</b> {{ $seller->username }}</span>
                                    </div>
                                    <div>
                                        <span><b>Phone:</b> +6{{ $seller->phone_number }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('user.chat',['seller_id' => $seller_id]) }}" target="_blank" class="btn btn-dark">Contact Seller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($flag == 'Product')
                    @php
                        $product_id = $order->product_id;
                        $product = \App\Models\Product::find($product_id);
                        $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                        $image = $disk->url($product->image);

                        $seller_id = $product->seller_id;
                        $seller = \App\Models\Seller::find($seller_id);
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
                            <div class="ms-3 d-flex flex-column justify-content-between border-end pe-3">
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
                                    <span><b>Seller Location:</b> {{ $seller->store_address }}</span>
                                </div>
                                <div>
                                    <span><b>Waze Link:</b> <a class="text-primary" href="https://waze.com/ul?ll={{ $seller->store_latitude }},{{ $seller->store_longitude }}&navigate=yes" target="_blank">Get waze direction</a></span>
                                </div>
                                <div>
                                    <span><b>Google Map Link:</b> <a class="text-primary" href="https://www.google.com/maps/search/?api=1&query={{ $seller->store_latitude }},{{ $seller->store_longitude }}" target="_blank">Get google map direction</a></span>
                                </div>
                            </div>
                            <div class="ps-3 d-flex flex-column justify-content-between">
                                <div>
                                    <div>
                                        <span><b>Seller:</b> {{ $seller->username }}</span>
                                    </div>
                                    <div>
                                        <span><b>Phone:</b> +6{{ $seller->phone_number }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('user.chat',['seller_id' => $seller_id]) }}" target="_blank" class="btn btn-dark">Contact Seller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="d-md-none">
            @foreach($orders as $order)
                @if($flag == 'Emergency')
                    @php
                        $emergency_id = $order->emergency_id;
                        $emegency = \App\Models\Emergency::find($emergency_id);
                        $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                        $image = $disk->url($emegency->image);

                        $seller_id = $emegency->seller_id;
                        $seller = \App\Models\Seller::find($seller_id);
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
                        <div class="px-2 mt-2">
                            <div class="d-flex">
                                <div class="image-box" style="border-radius: unset">
                                    <img src="{{ $image }}" alt="">
                                </div>
                                <div class="ms-3 d-flex flex-column justify-content-between">
                                    <div>
                                        <div>
                                            <span class="h3 truncate">{{ $emegency->name }}</span>
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
                            <div class="border-top border-bottom">
                                <div>
                                    <span><b>Your Location:</b> {{ $order->location }}</span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-between">
                                <div>
                                    <div>
                                        <span><b>Seller:</b> {{ $seller->username }}</span>
                                    </div>
                                    <div>
                                        <span><b>Phone:</b> +6{{ $seller->phone_number }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('user.chat',['seller_id' => $seller_id]) }}" target="_blank" class="btn btn-dark">Contact Seller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($flag == 'Product')
                    @php
                        $product_id = $order->product_id;
                        $product = \App\Models\Product::find($product_id);
                        $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                        $image = $disk->url($product->image);

                        $seller_id = $product->seller_id;
                        $seller = \App\Models\Seller::find($seller_id);
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
                        <div class="px-2 mt-2">
                            <div class="d-flex">
                                <div class="image-box" style="border-radius: unset">
                                    <img src="{{ $image }}" alt="">
                                </div>
                                <div class="ms-3 d-flex flex-column justify-content-between">
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
                            <div class="border-top border-bottom">
                                <div>
                                    <span><b>Seller Location:</b> {{ $seller->store_address }}</span>
                                </div>
                                <div>
                                    <span><b>Waze Link:</b> <a class="text-primary" href="https://waze.com/ul?ll={{ $seller->store_latitude }},{{ $seller->store_longitude }}&navigate=yes" target="_blank">Get waze direction</a></span>
                                </div>
                                <div>
                                    <span><b>Google Map Link:</b> <a class="text-primary" href="https://www.google.com/maps/search/?api=1&query={{ $seller->store_latitude }},{{ $seller->store_longitude }}" target="_blank">Get google map direction</a></span>
                                </div>
                            </div>
                            <div class="d-flex flex-column justify-content-between">
                                <div>
                                    <div>
                                        <span><b>Seller:</b> {{ $seller->username }}</span>
                                    </div>
                                    <div>
                                        <span><b>Phone:</b> +6{{ $seller->phone_number }}</span>
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('user.chat',['seller_id' => $seller_id]) }}" target="_blank" class="btn btn-dark">Contact Seller</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

</div>
