<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Emergency;

class EditEmergency extends Component
{
    use WithFileUploads;

    public $id;

    public $name;
    public $image;
    public $description;
    public $category;
    public $price_from;
    public $price_to;
    public $deposit;

    public $new_image;

    public function mount(){
        $emergency = Emergency::find($this->id);

        $this->name = $emergency->name;
        $this->description = $emergency->description;
        $this->category = $emergency->category;
        $this->price_from = $emergency->price_from;
        $this->price_to = $emergency->price_to;
        $this->deposit = $emergency->deposit;

        $disk = Storage::disk('gcs');
        $this->image = $disk->url($emergency->image);
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

        $emergency = Emergency::find($this->id);

        if($this->new_image){
            $filePath = $this->new_image->getRealPath();
            $fileName = Str::random(40) . '.' . $this->new_image->getClientOriginalExtension();

            $disk = Storage::disk('gcs');
            $disk->delete($emergency->image);
            $disk->put('service_image/' . $fileName, fopen($filePath, 'r'), [
                'visibility' => 'public',
            ]);

            $emergency->image = 'service_image/' . $fileName;
        }

        $emergency->name = $this->name;
        $emergency->description = $this->description;
        $emergency->category = $this->category;
        $emergency->price_from = $this->price_from;
        $emergency->price_to = $this->price_to;
        $emergency->deposit = $this->deposit;

        $emergency->save();

        return redirect()->route('seller.emergency');
    }

    public function render()
    {
        return view('livewire.seller.edit-emergency');
    }
}
