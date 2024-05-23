<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login(){
        $this->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ],[
            'email.exists' => 'Account with this email does not exist.'
        ]);

        if (auth()->guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            return $this->addError('password', 'Incorrect password.');
        }
    }

    public function render()
    {
        return view('livewire.admin.login');
    }
}
