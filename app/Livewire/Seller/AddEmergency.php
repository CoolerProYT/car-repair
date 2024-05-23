<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddEmergency extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $description;
    public $category;
    public $price_from;
    public $price_to;
    public $deposit;

    public function uploadService(){
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
        $disk->put('service_image/' . $fileName, fopen($filePath, 'r'), [
            'visibility' => 'public',
        ]);

        Auth::guard('seller')->user()->emergencies()->create([
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'price_from' => $this->price_from,
            'price_to' => $this->price_to,
            'deposit' => $this->deposit,
            'image' => 'service_image/' . $fileName
        ]);

        return redirect()->route('seller.emergency');
    }

    public function render()
    {
        return view('livewire.seller.add-emergency');
    }
}
