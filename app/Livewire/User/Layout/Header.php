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
        $this->redirect(route('user.product', ['category' => 'all', 'search' => $this->search]));
    }

    public function render()
    {
        return view('livewire.user.layout.header');
    }
}
