<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShopSettings extends Component
{
    public $store_name;
    public $store_address;
    public $store_latitude;
    public $store_longitude;
    public $open_time;
    public $close_time;
    public $area;
    public $state;

    public $flag = '';

    public function mount(){
        $this->store_name = Auth::guard('seller')->user()->store_name;
        $this->store_address = Auth::guard('seller')->user()->store_address;
        $this->store_latitude = Auth::guard('seller')->user()->store_latitude;
        $this->store_longitude = Auth::guard('seller')->user()->store_longitude;
        $this->open_time = Auth::guard('seller')->user()->open_time;
        $this->close_time = Auth::guard('seller')->user()->close_time;
        $this->area = Auth::guard('seller')->user()->area;
        $this->state = Auth::guard('seller')->user()->state;
    }

    public function updateFlag($flag){
        $this->flag = $flag;
    }

    public function changeName(){
        $this->validate([
            'store_name' => 'required|string|max:255',
        ]);

        Auth::guard('seller')->user()->update([
            'store_name' => $this->store_name,
        ]);

        $this->flag = '';
    }

    public function changeAddress(){
        $this->validate([
            'store_address' => 'required|string|max:255',
        ]);

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($this->store_address) . "&key=" . env('GOOGLE_MAP_API_KEY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        $location = $data['results'][0]['geometry']['location'];
        $this->store_latitude = $location['lat'];
        $this->store_longitude = $location['lng'];

        Auth::guard('seller')->user()->update([
            'store_address' => $this->store_address,
            'store_latitude' => $this->store_latitude,
            'store_longitude' => $this->store_longitude,
        ]);

        $this->flag = '';
    }

    public function changeTime(){
        $this->validate([
            'open_time' => 'required',
            'close_time' => 'required',
        ]);

        $this->open_time = date('H:i:s', strtotime($this->open_time));
        $this->close_time = date('H:i:s', strtotime($this->close_time));

        Auth::guard('seller')->user()->update([
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
        ]);

        $this->flag = '';
    }

    public function changeState(){
        $this->validate([
            'state' => 'required',
        ]);

        Auth::guard('seller')->user()->update([
            'state' => $this->state,
        ]);

        $this->flag = '';
    }

    public function changeArea(){
        $this->validate([
            'area' => 'required',
        ]);

        Auth::guard('seller')->user()->update([
            'area' => $this->area,
        ]);

        $this->flag = '';
    }

    public function render()
    {
        return view('livewire.seller.shop-settings');
    }
}
