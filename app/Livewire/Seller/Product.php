<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public $products;

    public function mount(){
        $this->products = ProductModel::where('seller_id', Auth::guard('seller')->user()->id)->get();
    }

    public function deleteProduct($id){
        $product = ProductModel::find($id);
        $image = $product->image;
        $disk = Storage::disk('gcs');
        $disk->delete($image);
        $product->delete();

        $this->products = ProductModel::where('seller_id', Auth::guard('seller')->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.seller.product');
    }
}
