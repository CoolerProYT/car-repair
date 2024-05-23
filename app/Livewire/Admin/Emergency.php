<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Emergency as EmergencyModel;

class Emergency extends Component
{
    public $flag = true;
    public $emergencies;

    public function mount()
    {
        $this->emergencies = EmergencyModel::where('approved', !$this->flag)->get();
    }

    public function updateFlag($flag)
    {
        $this->flag = $flag;
        $this->emergencies = EmergencyModel::where('approved', !$this->flag)->get();
    }

    public function approve($id)
    {
        $emergency = EmergencyModel::find($id);
        $emergency->approved = true;
        $emergency->save();
        $this->emergencies = EmergencyModel::where('approved', !$this->flag)->get();
    }

    public function deleteProduct($id){
        $emergency = EmergencyModel::find($id);
        $image = $emergency->image;
        $disk = Storage::disk('gcs');
        $disk->delete($image);
        $emergency->delete();

        $this->emergencies = EmergencyModel::where('approved', !$this->flag)->get();
    }

    public function render()
    {
        return view('livewire.admin.emergency');
    }
}
