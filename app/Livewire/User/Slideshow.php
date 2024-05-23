<?php

namespace App\Livewire\User;

use Livewire\Component;

class Slideshow extends Component
{
    public $slideshows;

    public function mount(){
        $this->slideshows = \App\Models\Slideshow::all();
    }

    public function render()
    {
        return view('livewire.user.slideshow');
    }
}
