<div class="my-5 container bg-white p-3">
    <div>
        <span class="h1">Checkout - Product</span>
    </div>

    <div class="my-3">
        <span class="h2">Product Detail</span>
        <div class="mt-2 d-flex">
            @php
                $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                $url = $disk->url($product->image);
            @endphp
            <div class="image-box" style="border-radius: unset">
                <img src="{{ $url }}" alt="">
            </div>
            <div class="ms-3">
                <div>
                    <span class="h3">{{ $product->name }}</span>
                </div>
                <div>
                    <span>Deposit: RM{{ number_format($product->deposit,2) }}</span>
                </div>
                <div>
                    <span>Quantity: {{ $quantity }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3">
        <span class="h3">Payment</span>
        <div class="dropdown mt-3 col-md-6">
            <button type="button" class="dropdown-toggle form-control" data-bs-toggle="dropdown">
                @if($payment_method == 'Card')
                    <img src="https://d2x73ruoixi2ei.cloudfront.net/images/logos/channels/32/visa-master.gif">
                @elseif($payment_method == 'FPX')
                    <img src="https://d2x73ruoixi2ei.cloudfront.net/images/logos/channels/32/fpx.gif">
                @endif
                {{ $payment_method ?  : 'Select Payment Method'}}
            </button>
            <ul class="dropdown-menu form-control">
                <li>
                    <input id="card" class="d-none" type="radio" wire:model.live="payment_method" value="Card">
                    <label for="card" class="pointer col-12 payment-method px-2"><img src="https://d2x73ruoixi2ei.cloudfront.net/images/logos/channels/32/visa-master.gif"> Card</label>
                </li>
                {{--<li>
                    <input id="FPX" class="d-none" type="radio" wire:model.live="payment_method" value="FPX">
                    <label for="FPX" class="pointer col-12 payment-method px-2"><img src="https://d2x73ruoixi2ei.cloudfront.net/images/logos/channels/32/fpx.gif"> FPX</label>
                </li>--}}
            </ul>
        </div>
        @error('payment_method') <span class="text-danger">{{ $message }}</span>  @enderror
        @if($payment_method == 'FPX')
            <div class="dropdown col-6 my-3">
                <button type="button" class="dropdown-toggle form-control" data-bs-toggle="dropdown">
                    @if($txn_channel)
                        @foreach($payment_channel->result as $result)
                            @if($result->channel_map->direct->request == $txn_channel)
                                <img src="{{ $result->logo_url_32x32 }}">
                                {{ $result->title }}
                            @endif
                        @endforeach
                    @else
                        Select Bank
                    @endif
                </button>
                <ul class="dropdown-menu form-control">
                    @foreach($payment_channel->result as $result)
                        @if($result->channel_type != 'EWO' && $result->channel_type != 'OTC' && $result->channel_type != 'CC')
                            <li>
                                <input id="{{$result->channel_map->direct->request}}" class="d-none" type="radio" wire:model.live="txn_channel" value="{{$result->channel_map->direct->request}}">
                                <label for="{{$result->channel_map->direct->request}}" class="pointer col-12 payment-method px-2"><img src="{{ $result->logo_url_32x32 }}"> {{ $result->title }}</label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @error('txn_channel') <span class="text-danger">{{ $message }}</span>  @enderror
        @elseif($payment_method == 'Card')
            <div class="my-3 col-12">
                <div>
                    <label>Card Number:</label>
                    <input type="number" class="form-control" wire:model="cc_pan" placeholder="5555555555554444">
                    @error('cc_pan') <span class="text-danger">{{ $message }}</span>  @enderror
                </div>
                <div class="d-md-flex col-12 my-3">
                    <div class="col-md-4">
                        <label>Card CVV:</label>
                        <input type="number" class="form-control" wire:model="cc_cvv2" placeholder="444">
                        @error('cc_cvv2') <span class="text-danger">{{ $message }}</span>  @enderror
                    </div>
                    <div class="col-md-4 px-md-3">
                        <label>Card Expired Month:</label>
                        <input type="number" class="form-control" wire:model="cc_month" placeholder="12">
                        @error('cc_month') <span class="text-danger">{{ $message }}</span>  @enderror
                    </div>
                    <div class="col-md-4">
                        <label>Card Expired Year:</label>
                        <input type="number" class="form-control" wire:model="cc_year" placeholder="2030">
                        @error('cc_year') <span class="text-danger">{{ $message }}</span>  @enderror
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="my-3">
        <span class="h2">Total Payment: RM{{ number_format($product->deposit * $quantity,2) }}</span>
    </div>
    <div>
        <button wire:click="checkout" class="btn btn-primary" wire:loading.attr="disabled">Pay</button>
    </div>
</div>
