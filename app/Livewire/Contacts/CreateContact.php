<?php

namespace App\Livewire\Contacts;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

    public $image;
    public $filePath =  "uploads/default.jpeg";
    public $contact;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.contacts.create-contact');
    }

    public function newContact(): void
    {
        $this->validate();

        if($this->image){
            $this->filePath = $this->image->store('uploads', 'public');
        } else {
            $this->filePath = "uploads/default.jpeg";
        }

        $this->contact = auth()
            ->user()
            ->contacts()
            ->updateOrCreate(
                ['email' => $this->email,],
                [
            'name' => $this->name,
            'firstname' => $this->firstname,
            'email' => $this->email,
            'image' => $this->filePath,
            'user_id' => auth()->id(),
        ]);

        $this->reset('name', 'email', 'firstname');
        $this->redirect('/');
    }
}
