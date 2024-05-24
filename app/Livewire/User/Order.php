<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Order extends Component
{
    public $flag = 'Emergency';
    public $orders;

    public function mount(){
        $this->loadOrders();
    }

    public function updateFlag($flag){
        $this->flag = $flag;

        $this->loadOrders();
    }

    public function loadOrders(){
        if($this->flag == 'Emergency'){
            $this->orders = Auth::guard('user')->user()->emergencyOrders()->orderBy('id','desc')->get();
        }
        else if($this->flag == 'Product'){
            $this->orders = Auth::guard('user')->user()->productOrders()->orderBy('id','desc')->get();
        }
    }

    public function render()
    {
        return view('livewire.user.order');
    }
}
