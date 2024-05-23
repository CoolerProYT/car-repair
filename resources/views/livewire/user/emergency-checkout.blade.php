<div class="my-5 container bg-white p-3">
    <div>
        <span class="h1">Checkout - Emergency Service</span>
    </div>
    <div class="address p-3 bg-light rounded my-2">
        <b>Detected Location: </b>
        <div>
            <input class="form-control" id="location" type="text" wire:model.live="location"
                   onchange="changeLocation()">
        </div>
        <div class="d-flex mt-3">
            <div class="col-6 pe-3">
                <b>Latitude: </b>
                <input class="form-control" id="lat" type="number" wire:model.live="latitude" step="0.00000001"
                       onchange="changeCoor()">

            </div>
            <div class="col-6 ps-3">
                <b>Longitude: </b>
                <input class="form-control" id="lon" type="number" wire:model.live="longitude" step="0.0000001"
                       onchange="changeCoor()">
            </div>
        </div>
        <button class="btn btn-primary mt-3" onclick="getCurrentLocation()">Get Current Location</button>
    </div>

    <div class="my-3">
        <span class="h2">Emergency Service Detail</span>
        <div class="mt-2 d-flex">
            @php
                $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                $url = $disk->url($emergency->image);
            @endphp
            <div class="image-box" style="border-radius: unset">
                <img src="{{ $url }}" alt="">
            </div>
            <div class="ms-3">
                <div>
                    <span class="h3">{{ $emergency->name }}</span>
                </div>
                <div>
                    <span>Deposit: RM{{ number_format($emergency->deposit,2) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3">
        <span class="h3">Payment</span>
        <div class="dropdown mt-3 col-6">
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
                <div class="d-flex col-12 my-3">
                    <div class="col-4">
                        <label>Card CVV:</label>
                        <input type="number" class="form-control" wire:model="cc_cvv2" placeholder="444">
                        @error('cc_cvv2') <span class="text-danger">{{ $message }}</span>  @enderror
                    </div>
                    <div class="col-4 px-3">
                        <label>Card Expired Month:</label>
                        <input type="number" class="form-control" wire:model="cc_month" placeholder="12">
                        @error('cc_month') <span class="text-danger">{{ $message }}</span>  @enderror
                    </div>
                    <div class="col-4">
                        <label>Card Expired Year:</label>
                        <input type="number" class="form-control" wire:model="cc_year" placeholder="2030">
                        @error('cc_year') <span class="text-danger">{{ $message }}</span>  @enderror
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="my-3">
        <span class="h2">Total Payment: RM{{ number_format($emergency->deposit,2) }}</span>
    </div>
    <div>
        <button wire:click="checkout" class="btn btn-primary">Pay</button>
    </div>
    <script>
        $(document).ready(function () {
            getCurrentLocation();
        });

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            getAddress(lat, lng);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    // alert("User denied the request for Geolocation.");
                    getAddress(3.0428392, 101.7410057);
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }

        function getAddress(lat, lng) {
            const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key={{ env('google_map_api_key') }}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {
                        const address = data.results[0].formatted_address;
                        @this.
                        set('latitude', lat);
                        @this.
                        set('longitude', lng);
                        @this.
                        set('location', address);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + data.status);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function changeLocation() {
            let address = $("#location").val();
            $.get(`https://maps.googleapis.com/maps/api/geocode/json?address=${address}&key={{ env('GOOGLE_MAP_API_KEY') }}`, function (data) {
                if (data && data.geometry && data.geometry.location) {
                    getAddress(data.results[0].geometry.location.lat, data.results[0].geometry.location.lng);
                } else {
                    @this.
                    set('latitude', 0);
                    @this.
                    set('longitude', 0);
                    @this.
                    set('location', 'Invalid Address');
                }
            })
        }

        function changeCoor() {
            let lat = $("#lat").val();
            let lon = $("#lon").val();
            getAddress(lat, lon);
        }
    </script>
</div>
