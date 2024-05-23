<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;

class AddProduct extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $image;
    public $category;
    public $price_from;
    public $price_to;
    public $deposit;

    public $categories;
    public $flag = false;
    public $new_category;

    public function mount(){
        $this->categories = Category::all();
    }

    public function uploadProduct(){
        $this->validate([
            'image' => 'required|image|max:4096',
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price_from' => 'required|numeric',
            'price_to' => 'required|numeric|gt:price_from',
            'deposit' => 'required|numeric|lt:price_to'
        ]);

        $filePath = $this->image->getRealPath();
        $fileName = Str::random(40) . '.' . $this->image->getClientOriginalExtension();

        $disk = Storage::disk('gcs');
        $disk->put('product_image/' . $fileName, fopen($filePath, 'r'), [
            'visibility' => 'public',
        ]);

        $product = Auth::guard('seller')->user()->products()->create([
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
            'deposit' => $this->deposit,
            'image' => 'product_image/' . $fileName
        ]);

        return redirect()->route('seller.product');
    }

    public function addCategory(){
        $this->validate([
            'new_category' => 'required|unique:categories,name'
        ]);

        Category::create([
            'name' => $this->new_category
        ]);

        $this->categories = Category::all();
        $this->flag = false;
        $this->new_category = '';
    }

    public function updateFlag($flag){
        $this->flag = $flag;

    }

    public function render()
    {
        return view('livewire.seller.add-product');
    }
}
