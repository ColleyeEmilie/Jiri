<?php

namespace App\Livewire\Contacts;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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
    public function mount($contact): void
    {
        $this->contact = $contact;
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.contacts.show');
    }
}
