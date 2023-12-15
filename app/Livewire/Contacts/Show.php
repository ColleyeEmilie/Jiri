<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class Show extends Component
{
    public $contact;

    public function mount($contact){
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.contacts.show');
    }
}
