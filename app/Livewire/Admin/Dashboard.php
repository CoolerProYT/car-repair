<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Product;
use App\Models\Emergency;
use App\Models\Withdraw;

class Dashboard extends Component
{
    public $product;
    public $emergency;
    public $withdraw;

    public function mount()
    {
        $this->product = Product::where('approved',false)->count();
        $this->emergency = Emergency::where('approved',false)->count();
        $this->withdraw = Withdraw::where('status','Pending')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
