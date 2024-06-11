<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Slideshow as SlideshowModel;
use Livewire\WithFileUploads;

class Slideshow extends Component
{
    use WithFileUploads;
    public $slideshows;
    public $image;

    public function mount(){
        $this->slideshows = SlideshowModel::all();
    }

    public function uploadSlideshow(){
        $this->validate([
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        $filePath = $this->image->getRealPath();
        $fileName = Str::random(40) . '.' . $this->image->getClientOriginalExtension();

        $disk = Storage::disk('gcs');
        $disk->put('slideshow/' . $fileName, fopen($filePath, 'r'), [
            'visibility' => 'public',
        ]);

        SlideshowModel::create([
            'image' => 'slideshow/' . $fileName,
        ]);

        $this->slideshows = SlideshowModel::all();

        $this->image = '';
    }

    public function deleteSlideshow($id){
        $slideshow = SlideshowModel::find($id);
        $disk = Storage::disk('gcs');
        $disk->delete($slideshow->image);
        $slideshow->delete();

        $this->slideshows = SlideshowModel::all();
    }

    public function render()
    {
        return view('livewire.admin.slideshow');
    }
}
