<div class="px-5 py-4">
    <div class="container bg-white p-3 shadow-sm">
        <div>
            <span class="h2">Withdraw Management</span>
        </div>
        <div class="my-3 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Bank Name</th>
                    <th>Account Name</th>
                    <th>Account Number</th>
                    <th>Amount (RM)</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($withdraws as $withdraw)
                    <tr>
                        <td>{{ $withdraw->bank_name }}</td>
                        <td>{{ $withdraw->account_name }}</td>
                        <td>{{ $withdraw->account_number }}</td>
                        <td>{{ $withdraw->amount }}</td>
                        <td>
                            <button wire:click="approve({{ $withdraw->id }})" class="btn btn-success">Approve</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
