<div class="px-5 py-4">
    @if(session()->has('success'))
        <div class="container my-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="bg-white p-3 container shadow-sm">
        <div>
            <span class="h1">Withdraw</span>
        </div>
        <div class="my-3 d-flex align-items-center">
            <span style="font-size: 20px"><b>Balance:</b> RM{{ number_format($balance,2) }}</span>
            @if(!$flag)
                <button class="btn btn-primary ms-3" wire:click="changeFlag(true)">Withdraw</button>
            @endif
        </div>
    </div>
    @if($flag)
        <div class="bg-white px-3 py-2 my-3 container shadow-sm">
            <div class="my-3">
                <span class="h3">Bank Account Information</span>
            </div>
            <div class="my-3">
                <label for="bank_name">Bank Name:</label>
                <input type="text" id="bank_name" wire:model="bank_name" class="form-control">
            </div>
            <div class="my-3">
                <label for="account_name">Account Name:</label>
                <input type="text" id="account_name" wire:model="account_name" class="form-control">
            </div>
            <div class="my-3">
                <label for="account_number">Account Number:</label>
                <input type="text" id="account_number" wire:model="account_number" class="form-control">
            </div>
            <div class="my-3">
                <label for="amount">Withdraw Amount (RM):</label>
                <input type="number" id="amount" wire:model="amount" class="form-control">
            </div>
            <div class="my-3">
                <button type="submit" wire:click="withdraw" class="btn btn-primary">Withdraw Now</button>
                <button type="button" wire:click="changeFlag(false)" class="btn btn-danger">Cancel</button>
            </div>
        </div>
    @endif

    <div class="bg-white px-3 py-2 my-3 container shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Account Name</th>
                    <th>Account Number</th>
                    <th>Amount (RM)</th>
                    <th>Status</th>
                    <th>Create On</th>
                    <th>Updated On</th>
                </tr>
                </thead>
                <tbody>
                @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->bank_name }}</td>
                        <td>{{ $withdraw->account_name }}</td>
                        <td>{{ $withdraw->account_number }}</td>
                        <td>{{ number_format($withdraw->amount,2) }}</td>
                        <td>{{ $withdraw->status }}</td>
                        <td>{{ $withdraw->created_at }}</td>
                        <td>{{ $withdraw->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
