<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Seller;

class Register extends Component
{
    use WithFileUploads;

    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $store_name;
    public $profile_image;
    public $phone_number;
    public $store_address;
    public $store_latitude;
    public $store_longitude;
    public $open_time;
    public $close_time;
    public $state;
    public $area;

    public function register(){
        $this->validate([
            'username' => 'required',
            'email' => 'required|email|unique:sellers,email',
            'password' => 'required|min:6|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:password',
            'phone_number' => 'required|regex:/^01[0-9]{8,9}$/',
            'profile_image' => 'required|image|max:4096',
            'store_name' => 'required',
            'store_address' => 'required',
            'store_latitude' => 'required',
            'store_longitude' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
            'state' => 'required',
            'area' => 'required',
        ]);

        $this->open_time = date('H:i:s', strtotime($this->open_time));
        $this->close_time = date('H:i:s', strtotime($this->close_time));

        $filePath = $this->profile_image->getRealPath();
        $fileName = Str::random(40) . '.' . $this->profile_image->getClientOriginalExtension();

        $disk = Storage::disk('gcs');
        $disk->put('seller_profile_image/' . $fileName, fopen($filePath, 'r'), [
            'visibility' => 'public',
        ]);

        Seller::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone_number' => $this->phone_number,
            'profile_image' => 'seller_profile_image/' . $fileName,
            'store_name' => $this->store_name,
            'store_address' => $this->store_address,
            'store_latitude' => $this->store_latitude,
            'store_longitude' => $this->store_longitude,
            'open_time' => $this->open_time,
            'close_time' => $this->close_time,
            'state' => $this->state,
            'area' => $this->area,
        ]);

        return redirect()->route('seller.login')->with('success', 'Your seller account has been created!');
    }

    public function updateCoordinate($lat,$lon){
        $this->store_latitude = $lat;
        $this->store_longitude = $lon;
    }

    public function render()
    {
        return view('livewire.seller.register');
    }
}
