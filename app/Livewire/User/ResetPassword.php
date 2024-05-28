<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Resend;

class ResetPassword extends Component
{
    public $email;
    public $password;
    public $confirm_password;
    public $verification_code;
    public $code_sent = false;

    public function getCode(){
        $this->validate([
            'email' => 'required|email|exists:users,email'
        ],[
            'email.exists' => 'Account with this email does not exist.'
        ]);

        $code = mt_rand(100000, 999999);

        $user = User::where('email', $this->email)->first();
        $user->verification_code = $code;
        $user->save();

        $this->code_sent = true;

        $resend = Resend::client(env('RESEND_API_KEY'));

        $resend->emails->send([
            'from' => 'noreply <noreply@' . env('RESEND_DOMAIN') .  '>',
            'to' => [$this->email],
            'subject' => 'Verification Code',
            'text' => "Your verification code is $code"
        ]);
    }

    public function resetPassword(){
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required',
            'password' => 'required|min:6|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:password'
        ],[
            'email.exists' => 'Account with this email does not exist.',
        ]);

        $code = User::where('email', $this->email)->first()->verification_code;
        if($code != $this->verification_code){
            $this->addError('verification_code', 'Incorrect verification code');
            return;
        }

        $user = User::where('email', $this->email)->first();
        $user->password = bcrypt($this->password);
        $user->verification_code = null;
        $user->save();

        return redirect()->route('user.login')->with('success', 'Your password has been changed!');
    }

    public function render()
    {
        return view('livewire.user.reset-password');
    }
}
