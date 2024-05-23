<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Emergency;
use App\Models\Product;

class Home extends Component
{
    public $emergencies;
    public $products;

    public function mount(){
        $this->emergencies = Emergency::limit(5)->where('approved', true)->get();
        $this->products = Product::limit(5)->where('approved', true)->get();
    }

    public function getEmergencyServices($state,$area){
        $this->emergencies = Emergency::join('sellers', 'emergencies.seller_id', '=', 'sellers.id')
            ->where('sellers.state', $state)
            ->orWhere('sellers.area', $area)
            ->select('emergencies.*')
            ->where('emergencies.approved', true)
            ->limit(5)
            ->get();
    }

    public function getProducts($state,$area){
        $this->products = Product::join('sellers', 'products.seller_id', '=', 'sellers.id')
            ->where('sellers.state', $state)
            ->orWhere('sellers.area', $area)
            ->select('products.*')
            ->where('products.approved', true)
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.user.home');
    }
}
