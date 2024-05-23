<div class="px-5">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-1">Image</th>
                <th>Product Name</th>
                <th>Price Range</th>
                <th>Deposit</th>
                <th class="text-center">Approved</th>
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
                            <img class="col-12" src="{{ $url }}">
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
                    <td style="vertical-align: middle" class="text-center">
                       <span class="{{ $product->approved ? 'text-success' : 'text-danger'}}">
                           {{ $product->approved ? 'Yes' : 'No'}}
                       </span>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <a href="{{ route('seller.product.edit',['id' => $product->id]) }}"><img src="{{ asset('icon/edit.svg') }}" class="action-icon bg-info rounded pointer"></a>
                        <a wire:click="deleteProduct('{{$product->id}}')"><img src="{{ asset('icon/delete.svg') }}" class="action-icon bg-danger rounded pointer"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
