<?php

namespace App\Livewire\Contacts;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if($this->image){
            $this->filePath = $this->image->store('uploads', 'public');
        } else {
            $this->filePath = "uploads/default.jpeg";
        }
        return view('livewire.contacts.edit-contact', ['contact']);
    }
}
