<div class="px-5 py-4">
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a wire:click="updateFlag(true)" class="nav-link pointer {{ $flag ? 'bg-primary text-light' : 'text-dark' }}">Not Approved</a>
            </li>
            <li class="nav-item">
                <a wire:click="updateFlag(false)" class="nav-link pointer {{ !$flag ? 'bg-primary text-light' : 'text-dark' }}">Approved</a>
            </li>
        </ul>
    </div>
    <div class="table-responsive my-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-1">Image</th>
                <th>Product Name</th>
                <th>Price Range</th>
                <th>Deposit</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    @php
                        $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                        $url = $disk->url($product->image);
                    @endphp
                    <td>
                        <div class="square-img">
                            <img style="max-height: 100%;max-width: 100%" src="{{ $url }}">
                        </div>
                    </td>
                    <td>
                        <span class="h4">{{ $product->name }}</span>
                    </td>
                    <td style="vertical-align: middle">
                        <span>RM {{ number_format($product->price_from,2) }}</span>
                        -
                        <span>RM {{ number_format($product->price_to,2) }}</span>
                    </td>
                    <td style="vertical-align: middle">
                        <span>RM {{ number_format($product->deposit,2) }}</span>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        @if($flag) <a wire:click="approveProduct('{{$product->id}}')"><img src="{{ asset('icon/white_tick.svg') }}" class="action-icon bg-success rounded pointer"></a> @endif
                        <a wire:click="deleteProduct('{{$product->id}}')"><img src="{{ asset('icon/white_cross.svg') }}" class="action-icon bg-danger rounded pointer"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
