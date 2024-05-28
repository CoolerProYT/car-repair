<?php

namespace App\Livewire\User;

use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use App\Models\Emergency;

class EmergencyDetail extends Component
{
    public $id;
    public $emergency;
    public $seller;
    public $image;
    public $current_time;

    public function mount(){
        $this->emergency = Emergency::with('seller')->find($this->id);
        $this->seller = $this->emergency->seller;

        $disk = Storage::disk('gcs');
        $this->image = $disk->url($this->emergency->image);

        $this->current_time = new DateTime();
    }
    public function checkout(){
        if(Auth::guard('user')->check()){
            return redirect()->route('user.emergency.checkout',['id' => $this->id]);
        }
        else{
            return redirect()->route('user.login',['redirect' => urlencode(route('user.emergency.detail',['id' => $this->id]))]);
        }
    }

    public function contactSeller(){
        if(Auth::guard('user')->check()){
            return redirect()->route('user.chat',['seller_id' => $this->seller->id]);
        }
        else{
            return redirect()->route('user.login',['redirect' => urlencode(route('user.chat',['seller_id' => $this->seller->id]))]);
        }
    }

    public function render()
    {
        return view('livewire.user.emergency-detail');
    }
}
