<?php

namespace App\Livewire\User;

use Livewire\Component;
use Resend;

class Contact extends Component
{
    public $name;
    public $email;
    public $message;
    public $subject;

    public function submit(){
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $resend = Resend::client(env('RESEND_API_KEY'));

        $resend->emails->send([
            'from' => 'Car Repair Contact Us <car-repair@jinitaimei.cloud>',
            'to' => ['veronlam1818@gmail.com'],
            'subject' => $this->subject,
            'text' => $this->message,
            'reply_to' => "{$this->name} <{$this->email}>",
        ]);

        session()->flash('message', 'Message sent successfully!');

        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.user.contact');
    }
}
