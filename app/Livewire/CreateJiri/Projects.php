<?php

namespace App\Livewire\CreateJiri;

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Projects extends Component
{
    public $projects;
    public $lastJiri;
    public $lastProjects;
    public $students;
    public $projectName = '';
    public $projectLink = '';
    public $projectPonderation = '';
    public $projectDescription = '';
    public $currentProject = '';

    #[computed]
    public function projectsList()
    {
        return $this->currentProject ? Project::where('name', 'like', '%' . $this->projectName . '%')->get() : new Collection();
    }

    public function students(){
        $this->students = Contact::
        join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.name', 'contacts.firstname','contacts.email', 'attendances.role')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }

    public function lastJiri()
    {
        $this->lastJiri = Jiri::orderBy('created_at', 'desc')->first();
    }

    public function lastProject()
    {
        $this->lastProject = Project::where('name', '=', $this->projectName)->first();
    }

    public function mount(){
        $this->lastJiri();
        $this->students();
    }

    public function render()
    {
        return view('livewire.create-jiri.projects');
    }
}
