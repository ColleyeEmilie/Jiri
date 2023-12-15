<?php

namespace App\Livewire\Contacts;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Show extends Component
{
    public $contact;
    public $jurys;


    public function jirisAsJury()
    {
        return auth()->user()->attendances()
            ->with('jiri')
            ->where('role', '=', 'jury')
            ->where('contact_id', '=', $this->contact->id)
            ->get();
    }

    public function jirisAsStudent()
    {
        return auth()->user()->attendances()
            ->with('jiri')
            ->where('role', '=', 'student')
            ->where('contact_id', '=', $this->contact->id)
            ->get();
    }
    public function mount($contact)
    {
        $this->contact = $contact;
    }

    public function render()
    {
        return view('livewire.contacts.show');
    }
}
