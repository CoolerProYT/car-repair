<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Product as ProductModel;

class Product extends Component
{
    public $flag = true;
    public $products;

    public function mount(){
        $this->products = ProductModel::where('approved', !$this->flag)->get();
    }

    public function updateFlag($flag)
    {
        $this->flag = $flag;

        $this->products = ProductModel::where('approved', !$this->flag)->get();
    }

    public function approveProduct($id){
        ProductModel::find($id)->update(['approved' => true]);

        $this->products = ProductModel::where('approved', !$this->flag)->get();
    }

    public function deleteProduct($id){
        $product = ProductModel::find($id);
        $image = $product->image;
        $disk = Storage::disk('gcs');
        $disk->delete($image);
        $product->delete();

        $this->products = ProductModel::where('approved', !$this->flag)->get();
    }

    public function render()
    {
        return view('livewire.admin.product');
    }
}
