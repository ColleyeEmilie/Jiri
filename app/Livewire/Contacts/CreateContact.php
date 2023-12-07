<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateContact extends Component
{
    use WithFileUploads;

    #[Rule('required', message: 'Un nom doit être entré!')]
    public $name = '';

    #[Rule('required', message: 'Un nom doit être entré!')]
    public $firstname = '';

    #[Rule('required|unique:contacts,email', message: 'une adresse email doit être rentrée!')]
    public $email = '';

    public $photo;
    public $contact;

    public function render()
    {
        return view('livewire.contacts.create-contact');
    }

    public function newContact()
    {
        $this->photo->store('photos');
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
            'image' => $this->photo,
            'user_id' => auth()->id(),
        ]);

        dd($this->contact);
        $this->reset('name', 'email', 'firstname');
        return view('livewire.contacts.display-contacts');
    }
}
