<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;

class DisplayContacts extends Component
{
    public $contacts;

    public function mount(){
        $this->contacts = Contact::orderBy('name','desc')->get();
    }

    public function render()
    {
        return view('livewire.contacts.display-contacts');
    }
}
