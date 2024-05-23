<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Emergency as EmergencyModel;

class Emergency extends Component
{
    public $emergencies;

    public function mount(){
        $this->emergencies = EmergencyModel::where('seller_id', Auth::guard('seller')->user()->id)->get();
    }

    public function deleteEmergency($id){
        $emergency = EmergencyModel::find($id);
        $image = $emergency->image;
        $disk = Storage::disk('gcs');
        $disk->delete($image);
        $emergency->delete();

        $this->emergencies = EmergencyModel::where('seller_id', Auth::guard('seller')->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.seller.emergency');
    }
}
