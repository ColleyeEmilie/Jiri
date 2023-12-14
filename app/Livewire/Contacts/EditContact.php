<?php

namespace App\Livewire\Contacts;

use Livewire\Component;
use Livewire\WithFileUploads;

class EditContact extends Component
{
    use WithFileUploads;
    public $contact;
    public $filePath =  "uploads/default.jpeg";
    public $image;

    public function mount($contact): void
    {
        $this->contact = $contact;
    }

    public function render()
    {
        if($this->image){
            $this->filePath = $this->image->store('uploads', 'public');
        } else {
            $this->filePath = "uploads/default.jpeg";
        }
        return view('livewire.contacts.edit-contact', ['contact']);
    }
}
