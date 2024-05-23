<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Emergency as EmergencyModel;

class Emergency extends Component
{
    public $category;
    public $state;
    public $area;
    public $emergencies;

    public function mount()
    {
        $this->emergencies = EmergencyModel::where('category', $this->category)->get();
    }

    public function filter(){
        if($this->state == '' && $this->area == ''){
            $this->emergencies = EmergencyModel::where('category', $this->category)->get();
        }
        else if($this->state == '' && $this->area != ''){
            $this->emergencies = EmergencyModel::join('sellers', 'emergencies.seller_id', '=', 'sellers.id')
                ->where('sellers.area', $this->area)
                ->select('emergencies.*')
                ->get();
        }
        else if($this->area == '' && $this->state != ''){
            $this->emergencies = EmergencyModel::join('sellers', 'emergencies.seller_id', '=', 'sellers.id')
                ->where('sellers.state', $this->state)
                ->select('emergencies.*')
                ->get();
        }
        else{
            $this->emergencies = EmergencyModel::join('sellers', 'emergencies.seller_id', '=', 'sellers.id')
                ->where('sellers.state', $this->state)
                ->orWhere('sellers.area', $this->area)
                ->select('emergencies.*')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.user.emergency');
    }
}
