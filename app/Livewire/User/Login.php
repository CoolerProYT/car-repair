<?php

namespace App\Livewire\User;

use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $redirect;

    public function login(){
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ],[
            'email.exists' => 'Account with this email does not exist.'
        ]);

        if (auth()->guard('user')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return $this->redirect($this->redirect);
        } else {
            return $this->addError('password', 'Incorrect password.');
        }
    }

    public function render()
    {
        return view('livewire.user.login');
    }
}
