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
            @foreach($emergencies as $emergency)
                <tr>
                    @php
                        $disk = \Illuminate\Support\Facades\Storage::disk('gcs');
                        $url = $disk->url($emergency->image);
                    @endphp
                    <td>
                        <div class="square-img">
                            <img style="max-height: 100%;max-width: 100%" src="{{ $url }}">
                        </div>
                    </td>
                    <td>
                        <span class="h4">{{ $emergency->name }}</span>
                    </td>
                    <td style="vertical-align: middle">
                        <span>RM {{ number_format($emergency->price_from,2) }}</span>
                        -
                        <span>RM {{ number_format($emergency->price_to,2) }}</span>
                    </td>
                    <td style="vertical-align: middle">
                        <span>RM {{ number_format($emergency->deposit,2) }}</span>
                    </td>
                    <td style="vertical-align: middle" class="text-center">
                       <span class="{{ $emergency->approved ? 'text-success' : 'text-danger'}}">
                           {{ $emergency->approved ? 'Yes' : 'No'}}
                       </span>
                    </td>
                    <td class="text-center" style="vertical-align: middle">
                        <a href="{{ route('seller.emergency.edit',['id' => $emergency->id]) }}"><img src="{{ asset('icon/edit.svg') }}" class="action-icon bg-info rounded pointer"></a>
                        <a wire:click="deleteEmergency('{{$emergency->id}}')"><img src="{{ asset('icon/delete.svg') }}" class="action-icon bg-danger rounded pointer"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
