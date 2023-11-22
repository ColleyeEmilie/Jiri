<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateContact extends Component
{
    #[Rule('required', message: 'Un nom doit être entré!')]
    public $name = '';
    #[Rule('required', message: 'Un nom doit être entré!')]
    public $firstname = '';
    #[Rule('required|unique:contacts,email', message: 'une adresse email doit être rentrée!')]
    public $email = '';
    public function render()
    {
        return view('livewire.contacts.create-contact');
    }
    public function newContact(){
        $this->validate();
        Contact::factory()->update([
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'user_id' => auth()->id(),
        ]);
        $this->reset('name', 'email');
    }
}
