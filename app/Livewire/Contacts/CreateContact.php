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

    public function newContact(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View
    {
        $this->validate();
        $this->contact = auth()
            ->user()
            ->contacts()
            ->updateOrCreate(
                ['email' => $this->email,],
                [
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'user_id' => auth()->id(),
        ]);
        $this->reset('name', 'email', 'firstname');
        return view('livewire.contacts.display-contacts');
    }
}
