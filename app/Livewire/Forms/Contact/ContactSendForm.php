<?php

namespace App\Livewire\Forms\Contact;

use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactSendForm extends Form
{

    public $openSuccess = false;

    public $email, $subject, $message;

    public function rules() 
    {
        return [
            'email' => 'required|email',
            'subject' => 'required|min:5|max:150',
            'message' => 'required|min:10|max:2000',
        ];
    }

    public function messages() 
    {
        return [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo debe ser una dirección válida.',
            'subject.required' => 'El asunto es obligatorio.',
            'subject.min' => 'El asunto debe tener al menos 5 caracteres.',
            'subject.max' => 'El asunto no debe exceder los 150 caracteres.',
            'message.required' => 'El mensaje es obligatorio.',
            'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'message.max' => 'El mensaje no debe exceder los 2000 caracteres.'
        ];
    }

    public function send(){

        $this->validate();

        $data['name'] = auth()->user()->name;
        $data['email'] =$this->email;
        $data['subject'] = $this->subject;
        $data['message'] = $this->message;

        $this->openSuccess = true;

        Mail::to($data['email'])->send(new ContactMailable($data));

        $this->reset(['email', 'subject', 'message']);
    }

}
