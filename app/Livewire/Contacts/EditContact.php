<?php

namespace App\Livewire\Contacts;

use Livewire\Component;

class EditContact extends Component
{
    public $contact;

    public function mount($contact): void
    {
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.contacts.edit-contact', ['contact']);
    }
}
