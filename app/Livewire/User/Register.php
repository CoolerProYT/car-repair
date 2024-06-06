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
    public $verification_code;
    public $correct_code;

    public function register(){
        $this->validate([
            'username' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:password',
            'phone' => 'required|regex:/^01[0-9]{8,9}$/|unique:users,phone_number',
            'verification_code' => 'required'
        ]);

        if($this->verification_code != $this->correct_code){
            return $this->addError('verification_code', 'The verification code is incorrect!');
        }

        User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'phone_number' => $this->phone
        ]);

        return redirect()->route('user.login')->with('success', 'Your account has been created!');
    }

    public function getCode(){
        $this->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $this->correct_code = rand(100000,999999);

        $resend = \Resend::client(env('RESEND_API_KEY'));

        $resend->emails->send([
            'from' => 'noreply <noreply@jinitaimei.cloud>',
            'to' => [$this->email],
            'subject' => 'Verification Code',
            'text' => "Your verification code is: $this->correct_code"
        ]);

        return session()->flash('success', 'Verification code has been sent to your email!');
    }

    public function render()
    {
        return view('livewire.user.register');
    }
}
