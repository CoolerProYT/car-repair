<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Withdraw as WithdrawModel;

class Withdraw extends Component
{
    public $balance;
    public $flag = false;

    public $bank_name;
    public $account_name;
    public $account_number;
    public $amount;

    public $withdraws;

    public function mount(){
        $this->balance = Auth::guard('seller')->user()->balance;
        $this->loadWithdraw();
    }

    public function changeFlag($flag){
        $this->flag = $flag;
    }

    public function withdraw(){
        $this->validate([
            'bank_name' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'amount' => 'required|numeric|min:1|max:'.$this->balance,
        ]);

        $seller = Auth::guard('seller')->user();
        $seller->balance -= $this->amount;
        $seller->save();

        WithdrawModel::create([
            'seller_id' => $seller->id,
            'bank_name' => $this->bank_name,
            'account_name' => $this->account_name,
            'account_number' => $this->account_number,
            'amount' => $this->amount,
        ]);

        $this->flag = false;
        $this->balance = Auth::guard('seller')->user()->balance;
        $this->loadWithdraw();

        return session()->flash('success', 'Withdraw request has been sent successfully.');
    }

    public function loadWithdraw(){
        $this->withdraws = Auth::guard('seller')->user()->withdraws()->get();
    }

    public function render()
    {
        return view('livewire.seller.withdraw');
    }
}
