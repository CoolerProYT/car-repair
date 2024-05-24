<?php

namespace App\Livewire\User;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Product;

class ProductDetail extends Component
{
    public $id;
    public $product;
    public $seller;
    public $image;
    public $quantity = 1;
    public $current_time;

    public function mount(){
        $this->product = Product::with('seller')->find($this->id);
        $this->seller = $this->product->seller;

        $disk = Storage::disk('gcs');
        $this->image = $disk->url($this->product->image);

        $this->current_time = new DateTime();
    }

    public function checkout(){
        if(Auth::guard('user')->check()){
            return redirect()->route('user.product.checkout',['id' => $this->id,'quantity' => $this->quantity]);
        }
        else{
            return redirect()->route('user.login',['redirect' => urlencode(route('user.product.detail',['id' => $this->id]))]);
        }
    }

    public function render()
    {
        return view('livewire.user.product-detail');
    }
}
