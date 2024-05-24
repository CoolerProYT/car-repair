<?php

namespace App\Livewire\Seller;

use App\Models\EmergencyOrder;
use App\Models\ProductOrder;
use Livewire\Component;

class Order extends Component
{
    public $flag = 'Emergency';
    public $status = 'Pending';
    public $orders;

    public function mount(){
        $this->loadOrders();
    }

    public function changeFlag($flag)
    {
        $this->flag = $flag;
        $this->status = 'Pending';

        $this->loadOrders();
    }

    public function changeStatus($status)
    {
        $this->status = $status;

        $this->loadOrders();
    }

    public function loadOrders(){
        if($this->flag == 'Emergency'){
            $this->orders = auth()->guard('seller')->user()->emergencyOrders()->where('status', $this->status)->orderBy('id','desc')->get();
        }
        else if($this->flag == 'Product'){
            $this->orders = auth()->guard('seller')->user()->productOrders()->where('status', $this->status)->get();
        }
    }

    public function updateOrderStatus($status, $id){
        $order = $this->flag == 'Emergency' ? EmergencyOrder::find($id) : ProductOrder::find($id);
        $order->status = $status;
        $order->save();

        $this->loadOrders();

    }

    public function render()
    {
        return view('livewire.seller.order');
    }
}
