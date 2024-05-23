<?php

namespace App\Livewire\Seller;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class EditProduct extends Component
{
    use WithFileUploads;

    public $id;

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
    public $new_image;

    public function mount(){
        $this->categories = Category::all();

        $product = Product::find($this->id);

        $this->name = $product->name;
        $this->description = $product->description;
        $this->category = $product->category;
        $this->price_from = $product->price_from;
        $this->price_to = $product->price_to;
        $this->deposit = $product->deposit;

        $disk = Storage::disk('gcs');
        $this->image = $disk->url($product->image);
    }

    public function save(){
        $this->validate([
            'new_image' => 'nullable|image|max:4096',
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price_from' => 'required|numeric',
            'price_to' => 'required|numeric|gt:price_from',
            'deposit' => 'required|numeric|lt:price_to'
        ]);

        $product = Product::find($this->id);

        if($this->new_image){
            $filePath = $this->new_image->getRealPath();
            $fileName = Str::random(40) . '.' . $this->new_image->getClientOriginalExtension();

            $disk = Storage::disk('gcs');
            $disk->delete($product->image);
            $disk->put('product_image/' . $fileName, fopen($filePath, 'r'), [
                'visibility' => 'public',
            ]);

            $product->image = 'product_image/' . $fileName;
        }

        $product->name = $this->name;
        $product->description = $this->description;
        $product->category = $this->category;
        $product->price_from = $this->price_from;
        $product->price_to = $this->price_to;
        $product->deposit = $this->deposit;

        $product->save();

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
        return view('livewire.seller.edit-product');
    }
}
