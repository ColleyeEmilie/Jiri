<?php

namespace App\Livewire\Jiri;

use App\Models\Contact;
use App\Models\Project;
use Livewire\Component;

class Edit extends Component
{
    public $jiri;
    public $jurys;
    public $students;
    public $projects;

    public function mount($jiri){

        $this->jiri = $jiri;
        $this->addJurys();
        $this->students();
        $this->projects();
    }

    public function addJurys()
    {
        $this->jurys = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id')
            ->where('role', '=', 'jury')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function students(): void
    {
        $this->students = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.id', 'contacts.name', 'contacts.firstname', 'contacts.email', 'attendances.role')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function projects(): void
    {
        $this->projects = Project::join('duties','projects.id', '=', 'duties.project_id' )
            ->select('*')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function render()
    {
        return view('livewire.jiri.edit');
    }
}
