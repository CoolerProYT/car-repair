<?php

namespace App\Livewire\User\Layout;

use App\Models\Category;
use Livewire\Component;

class Header extends Component
{
    public $search;
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function searchProduct()
    {

    }

    public function render()
    {
        return view('livewire.user.layout.header');
    }
}
