<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayContacts extends Component
{
    use WithPagination;

    public function render()
    {

        return view('livewire.contacts.display-contacts', ['contacts' => Contact::orderBy('name', 'asc')->paginate(15)]);
    }
}
