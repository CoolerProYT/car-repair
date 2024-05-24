<?php

namespace App\Livewire\Admin;

use App\Models\Seller;
use Livewire\Component;
use App\Models\Withdraw as WithdrawModel;
use Resend;

class Withdraw extends Component
{
    public $withdraws;

    public function mount(){
        $this->loadWithdraw();
    }

    public function loadWithdraw(){
        $this->withdraws = WithdrawModel::where('status', 'Pending')->get();
    }

    public function approve($id){
        $withdraw = WithdrawModel::find($id);
        $withdraw->status = 'Approved';
        $withdraw->save();

        $seller_id = $withdraw->seller_id;
        $seller = Seller::find($seller_id);

        $resend = Resend::client(env('resend_api_key'));

        $resend->emails->send([
            'from' => 'noreply <noreply@jinitaimei.cloud>',
            'to' => [$seller->email],
            'subject' => 'Your withdraw request has been approved',
            'text' => "Your withdraw request has been approved. Please check your account for the money. Thank you."
        ]);

        $this->loadWithdraw();
    }

    public function render()
    {
        return view('livewire.admin.withdraw');
    }
}
