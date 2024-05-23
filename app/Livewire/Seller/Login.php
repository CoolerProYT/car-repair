<?php

namespace App\Livewire\Seller;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login(){
        $this->validate([
            'email' => 'required|email|exists:sellers,email',
            'password' => 'required'
        ],[
            'email.exists' => 'Account with this email does not exist.'
        ]);

        if (auth()->guard('seller')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('seller.dashboard');
        } else {
            return $this->addError('password', 'Incorrect password.');
        }
    }

    public function render()
    {
        return view('livewire.seller.login');
    }
}
