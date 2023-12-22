<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class DisplayContacts extends Component
{
    use WithPagination;

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.contacts.display-contacts', ['contacts' => Contact::orderBy('name', 'asc')->paginate(15)]);
    }
}
