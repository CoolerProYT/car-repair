<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $flag = '';
    public $profile_image;
    public $username;
    public $email;
    public $phone_number;
    public $password;

    public $new_password;
    public $confirm_password;

    public $new_profile_image;
    public $new_phone_number;


    public function mount(){
        $disk = Storage::disk('gcs');
        $this->profile_image = $disk->url(Auth::guard('user')->user()->profile_image);
        $this->username = Auth::guard('user')->user()->username;
        $this->email = Auth::guard('user')->user()->email;
        $this->phone_number = Auth::guard('user')->user()->phone_number;
    }

    public function changeImage(){
        $this->validate([
            'new_profile_image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $filePath = $this->new_profile_image->getRealPath();
        $fileName = Str::random(40) . '.' . $this->new_profile_image->getClientOriginalExtension();

        $disk = Storage::disk('gcs');

        if(Auth::guard('user')->user()->profile_image != 'profile-image/defaultProfile.jpeg')
            $disk->delete(Auth::guard('user')->user()->profile_image);

        $disk->put('profile_image/' . $fileName, fopen($filePath, 'r'), [
            'visibility' => 'public',
        ]);

        Auth::guard('user')->user()->update([
            'profile_image' => 'profile_image/' . $fileName,
        ]);

        $this->profile_image = $disk->url(Auth::guard('user')->user()->profile_image);
        $this->flag = '';

        $this->dispatch('updated');
    }

    public function changeUsername(){
        $this->validate([
            'username' => 'required|string|max:255',
        ]);

        Auth::guard('user')->user()->update([
            'username' => $this->username,
        ]);

        $this->flag = '';

        $this->dispatch('updated');
    }

    public function changeEmail(){
        $this->validate([
            'email' => 'required|email|max:255|unique:users,email,' . Auth::guard('user')->user()->id,
        ]);

        Auth::guard('user')->user()->update([
            'email' => $this->email,
        ]);

        $this->flag = '';
    }

    public function changePhoneNumber(){
        $this->validate([
            'new_phone_number' => 'required|regex:/^01[0-9]{8,9}$/|unique:users,phone_number',
        ]);

        Auth::guard('user')->user()->update([
            'phone_number' => $this->phone_number,
        ]);

        $this->flag = '';
    }

    public function changePassword(){
        if(!password_verify($this->password, Auth::guard('user')->user()->password)){
            return $this->addError('password', 'The password is incorrect.');
        }

        $this->validate([
            'new_password' => 'required|min:6|different:password|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:new_password',
        ]);

        Auth::guard('user')->user()->update([
            'password' => bcrypt($this->new_password),
        ]);

        $this->flag = '';
    }

    public function updateFlag($flag){
        $this->flag = $flag;
    }

    public function render()
    {
        return view('livewire.user.settings');
    }
}
