<?php

namespace App\Livewire\Contact;

use App\Livewire\Forms\Contact\ContactSendForm;
use Livewire\Component;

class ContactForm extends Component
{

    public ContactSendForm $contactSend;

    public function send(){

        $this->contactSend->send();                
    }

    public function render()
    {
        return view('livewire.contact.contact-form');
    }
}
