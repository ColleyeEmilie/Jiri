<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Models\Jiri;
use Livewire\Component;

class JiriCreate extends Component
{
    public $jurys;
    public $students;
    public $contacts;
    public $lastJiri;

    public function lastJiri()
    {
        $this->lastJiri = Jiri::orderBy('created_at', 'desc')->first();
    }
    public function addJurys()
    {
        $this->jurys = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id')
            ->where('role', '=', 'jury')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }
    public function addStudents()
    {
        $this->students = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }


    public function addContacts(){
        $this->contacts = Contact::get();
    }
    public function render()
    {
        $this->lastJiri();
        $this->addStudents();
        $this->addJurys();
        $this->addContacts();

        return view('livewire.jiri-create');
    }
}
