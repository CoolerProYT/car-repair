<div class="container">
    <div class="slide bg-white border-bottom d-flex justify-content-center align-items-center">
        <img src="{{ $image }}">
    </div>

    <div class="my-3 p-3 bg-white shadow-sm">
        <div>
            <span class="h3">{{ $product->name }}</span>
        </div>
        <div>
            <span class="h5">RM{{ number_format($product->price_from,2) }} - RM{{ number_format($product->price_to,2) }}</span>
        </div>
        <div>
            <span class="h5">Deposit: RM{{ number_format($product->deposit,2) }}</span>
        </div>
    </div>

    <div class="my-3 p-3 bg-white shadow-sm">
        <b>Quantity: </b>
        <input type="number" wire:model.live="quantity" class="form-control">
    </div>


    <div class="my-3 p-3 bg-white shadow-sm d-flex">
        <div class="col-6 pe-3">
            @php
                $currentTime = (new DateTime())->format('H:i');
                $openTime = (new DateTime($seller->open_time))->format('H:i');
                $closeTime = (new DateTime($seller->close_time))->format('H:i');
            @endphp

            @if ($currentTime < $openTime || $currentTime > $closeTime)
                <a class="btn btn-danger col-12">Closed</a>
            @else
                <a wire:click="checkout" class="btn btn-success col-12">Buy Now</a>
            @endif
        </div>
        <div class="col-6 ps-3">
            <a href="{{ route('user.chat',['seller_id' => $seller->id]) }}" class="btn btn-info text-light col-12" target="_blank">Contact Seller</a>
        </div>
    </div>

    <div class="my-3 p-3 bg-white shadow-sm">
        <span class="h3">Product Description</span>
    </div>

    <div class="my-3 p-3 bg-white shadow-sm">
        <pre><b>(Contact Seller to confirm your time slot)</b><br>{{ $product->description }}</pre>
    </div>

    <div class="my-3 p-3 bg-white shadow-sm">
        <span class="h3">Seller Information</span>
    </div>

    <div class="my-3 p-3 bg-white shadow-sm">
        <span><b>Seller Name:</b> {{ $seller->username }}</span>
        <br>
        <span><b>Seller Address:</b> {{ $seller->store_address }}</span>
        <br>
        <span><b>Seller Contact:</b> +6{{ $seller->phone_number }}</span>
        <br>
        <span><b>Working Hours:</b> {{ (new DateTime($seller->open_time))->format('h:i A') }} - {{ (new DateTime($seller->close_time))->format('h:i A') }}</span>
        <br>
        <span><b>State:</b> {{ $seller->state }}</span>
        <br>
        <span><b>Area:</b> {{ $seller->area}}</span>
        <br>
        <span><b>Waze Link:</b> <a class="text-primary" href="https://waze.com/ul?ll={{ $seller->store_latitude }},{{ $seller->store_longitude }}&navigate=yes" target="_blank">Get waze direction</a></span>
        <br>
        <span><b>Google Map Link:</b> <a class="text-primary" href="https://www.google.com/maps/search/?api=1&query={{ $seller->store_latitude }},{{ $seller->store_longitude }}" target="_blank">Get google map direction</a></span>
    </div>
</div>
