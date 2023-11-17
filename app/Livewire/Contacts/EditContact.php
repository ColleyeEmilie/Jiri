<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditContact extends Component
{
    #[Rule('required', message: 'Un nom doit être entré!')]
    public $name = '';
    #[Rule('required', message: 'Un nom doit être entré!')]
    public $firstname = '';
    #[Rule('required|unique:contacts,email', message: 'une adresse email doit être rentrée!')]
    public $email = '';

    public function render()
    {
        return view('livewire.contacts.edit-contact');
    }
    public function editContact(){
        $this->validate();

    }
}
