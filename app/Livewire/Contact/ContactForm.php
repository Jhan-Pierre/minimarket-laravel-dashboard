<?php

namespace App\Livewire\Contact;

use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{

    public $email, $subject, $message;

    public function store(){
        $data['name'] = auth()->user()->name;
        $data['email'] =$this->email;
        $data['subject'] = $this->subject;
        $data['message'] = $this->message;
        
        Mail::to($data['email'])->send(new ContactMailable($data));
    }

    public function render()
    {
        return view('livewire.contact.contact-form');
    }
}
