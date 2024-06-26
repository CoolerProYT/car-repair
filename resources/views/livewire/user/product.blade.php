<div class="bg-dark-gray">
    <div class="container py-5" style="min-height: 100vh">
        <div class="d-md-flex align-items-center justify-content-between">
            <span class="h1 text-light">Product Category - {{ $category }}</span>
            <div class="d-flex">
                <select wire:change="getArea" wire:model="state" id="state" class="form-select">
                    <option value="" selected>--Filter State--</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Putrajaya">Putrajaya</option>
                </select>
                <select wire:model="area" id="area" class="form-select ms-3">
                    <option value="" selected>--Select Area--</option>
                    @foreach($areas as $area)
                        <option value="{{ $area }}">{{ $area }}</option>
                    @endforeach
                </select>
                <button wire:click="filter" class="btn btn-primary ms-3">Filter</button>
            </div>
        </div>

        <div class="my-3 d-flex flex-wrap">
            @foreach($products as $product)
                @php
                    $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                    $url = $disk->url($product->image);
                @endphp
                <div class="product-card pointer my-2" onclick="location.href = '{{ route('user.product.detail',['id' => $product->id]) }}'">
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
                    <span class="h2">No Product Available</span>
                </div>
            @endif
        </div>
    </div>

</div>
