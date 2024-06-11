<div class="bg-dark-gray">
    @livewire('user.slideshow')
    <div class="container my-5">
        <span class="h1 text-light">Emergency Service Near You</span>
        <div class="my-3 d-flex flex-wrap">
            @foreach($emergencies as $emergency)
                @php
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $url = $disk->url($emergency->image);
                @endphp
                <div class="home-card pointer my-2 my-md-0" onclick="location.href = '{{ route('user.emergency.detail',['id' => $emergency->id]) }}'">
                    <div class="image border border-danger">
                        <img src="{{ $url }}">
                    </div>
                    <div>
                        <span class="h2 truncate">{{ $emergency->name }}</span>
                    </div>
                    <div>
                        <span class="h5">RM{{ number_format($emergency->price_from,2) }} - RM{{ number_format($emergency->price_to,2) }}</span>
                    </div>
                    <div>
                        <span class="h6">Deposit: RM{{ number_format($emergency->deposit,2) }}</span>
                    </div>
                </div>
            @endforeach
            @if($emergencies->count() === 0)
                <div class="col-12 py-5 text-center bg-white">
                    <span class="h2">No Emergency Service Nearby Available</span>
                </div>
            @endif
        </div>
    </div>
    <div class="container mt-5">
        <span class="h1 text-light">Seller Near You</span>
        <div class="mt-3 pb-3 d-flex flex-wrap">
            @foreach($products as $product)
                @php
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $url = $disk->url($product->image);
                @endphp
                <div class="home-card pointer my-2 my-md-0" onclick="location.href = '{{ route('user.product.detail',['id' => $product->id]) }}'">
                    <div class="image border border-danger">
                        <img src="{{ $url }}">
                    </div>
                    <div>
                        <span class="h2 truncate">{{ $product->name }}</span>
                    </div>
                    <div>
                        <span class="h5">RM{{ number_format($product->price_from,2) }} - RM{{ number_format($product->price_to,2) }}</span>
                    </div>
                    <div>
                        <span class="h6">Deposit: RM{{ number_format($product->deposit,2) }}</span>
                    </div>
                </div>
            @endforeach
                @if($products->count() === 0)
                    <div class="col-12 py-5 text-center bg-white">
                        <span class="h2">No Seller Nearby Available</span>
                    </div>
                @endif
        </div>
    </div>
    <script>
        $(document).ready(function () {
            navigator.geolocation.getCurrentPosition((position) => {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                $.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key={{ env('GOOGLE_MAP_API_KEY') }}`, function (data){
                    if (data.status === "OK") {
                        var results = data.results[0].address_components;
                        var state = "";
                        var area = "";

                        results.forEach(component => {
                            if (component.types.includes("administrative_area_level_1")) {
                                state = component.long_name;
                            }
                            if (component.types.includes("locality")) {
                                area = component.long_name;
                            }
                        });

                        @this.call('getEmergencyServices', state, area);
                        @this.call('getProducts', state, area);
                    } else {
                        console.error("Geocode was not successful for the following reason: " + data.status);
                    }
                })
            });

        });
    </script>
</div>
