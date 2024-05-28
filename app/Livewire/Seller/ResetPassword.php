<?php

namespace App\Livewire\Seller;

use App\Models\Seller;
use Livewire\Component;
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
            'email' => 'required|email|exists:sellers,email'
        ],[
            'email.exists' => 'Account with this email does not exist.'
        ]);

        $code = mt_rand(100000, 999999);

        $seller = Seller::where('email', $this->email)->first();
        $seller->verification_code = $code;
        $seller->save();

        $this->code_sent = true;

        $resend = Resend::client(env('RESEND_API_KEY'));

        $resend->emails->send([
            'from' => "noreply <noreply@" . env('RESEND_DOMAIN') . ">",
            'to' => [$this->email],
            'subject' => 'Verification Code',
            'text' => "Your verification code is $code"
        ]);
    }

    public function resetPassword(){
        $this->validate([
            'email' => 'required|email|exists:sellers,email',
            'verification_code' => 'required',
            'password' => 'required|min:6|regex:/^(?=.*\d).+/',
            'confirm_password' => 'same:password'
        ],[
            'email.exists' => 'Account with this email does not exist.',
        ]);

        $code = Seller::where('email', $this->email)->first()->verification_code;
        if($code != $this->verification_code){
            $this->addError('verification_code', 'Incorrect verification code');
            return;
        }

        $seller = Seller::where('email', $this->email)->first();
        $seller->password = bcrypt($this->password);
        $seller->verification_code = null;
        $seller->save();

        return redirect()->route('seller.login')->with('success', 'Your password has been changed!');
    }

    public function render()
    {
        return view('livewire.seller.reset-password');
    }
}
