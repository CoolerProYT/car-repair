<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $phone;

    public function register(){
        $this->validate([
            'username' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:password',
            'phone' => 'required|regex:/^01[0-9]{8,9}$/'
        ]);

        User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone_number' => $this->phone
        ]);

        return redirect()->route('user.login')->with('success', 'Your account has been created!');
    }

    public function render()
    {
        return view('livewire.user.register');
    }
}
