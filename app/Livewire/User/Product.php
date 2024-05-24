<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public $category;
    public $state;
    public $area;
    public $products;
    public $search;

    public function mount()
    {
        $this->filter();
    }

    public function filter(){
        $products = ProductModel::where('approved', true);

        if($this->state == '' && $this->area == '' && $this->category != 'all'){
            $products = $products->where('category', $this->category);
        }
        else if($this->state == '' && $this->area != ''){
            $products = $products->join('sellers', 'products.seller_id', '=', 'sellers.id')
                ->where('sellers.area', $this->area)
                ->select('products.*');
        }
        else if($this->area == '' && $this->state != ''){
            $products = $products->join('sellers', 'products.seller_id', '=', 'sellers.id')
                ->where('sellers.state', $this->state)
                ->select('products.*');
        }
        else if($this->area != '' && $this->state != ''){
            $products = $products->join('sellers', 'products.seller_id', '=', 'sellers.id')
                ->where('sellers.state', $this->state)
                ->where('sellers.area', $this->area)
                ->select('products.*');
        }

        if($this->search != ''){
            $products = $products->where('name', 'like', '%'.str_replace(' ','%',$this->search).'%');
        }
        
        $this->products = $products->get();
    }


    public function render()
    {
        return view('livewire.user.product');
    }
}
