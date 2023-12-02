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

    public $addDuties;

    public $projectName = '';

    public $projectLink = '';

    public $projectPonderation = '';

    public $projectDescription = '';

    public $currentProject = '';

    public $infoCurrentProject;

    public ?int $projectId;

    #[computed]
    public function projectsList()
    {
        return $this->currentProject ? Project::where('name', 'like', '%'.$this->projectName.'%')->get() : new Collection();
    }

    public function students()
    {
        $this->students = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.id', 'contacts.name', 'contacts.firstname', 'contacts.email', 'attendances.role')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }

    public function projects(){
        $this->projects = Project::join('duties','projects.id', '=', 'duties.project_id' )
            ->select('*')
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

    public function mount($projectId = 0): void
    {
        $this->projectId = $projectId;
        if ($projectId) {
            $project = auth()
                ->user()
                ?->projects()
                ->findOrFail($projectId);

            $this->projectName = $project->name;
            $this->projectLink = $project->link;
            $this->projectPonderation = $project->ponderation;
            $this->projectDescription = $project->description;
        } else {
            $this->projectName = '';
            $this->projectLink = '';
            $this->projectPonderation = '';
            $this->projectDescription = '';
        }
        $this->lastJiri();
        $this->projects();
        $this->students();
    }

    public function newProject()
    {
        if ($this->projectName === '') {
            $this->infoCurrentProject = preg_split('/[,:;]+/', $this->currentProject);
            if (count($this->infoCurrentProject) === 4) {
                $this->projectName = $this->infoCurrentProject[0];
                $this->projectLink = $this->infoCurrentProject[1];
                $this->projectPonderation = $this->infoCurrentProject[2];
                $this->projectDescription = $this->infoCurrentProject[3];
            }
            $this->projectName = $this->infoCurrentProject[0];
            $this->projectLink = $this->infoCurrentProject[1];
            $this->projectPonderation = $this->infoCurrentProject[2];
            $this->projectDescription = $this->infoCurrentProject[3];
        }
        $this->projectId = auth()
            ->user()
            ?->projects()
            ->updateOrCreate(
                ['name' => $this->projectName],
                [
                    'name' => $this->projectName,
                    'link' => $this->projectLink,
                    'ponderation' => $this->projectPonderation,
                    'description' => $this->projectDescription,
                ]
            )->id;

        $this->lastJiri();
        $this->lastProject();
        $this->students();
        $this->addDuties();
        $this->reset('infoCurrentProject', 'projectName', 'projectLink', 'projectDescription', 'projectPonderation');
    }

    public function render()
    {
        return view('livewire.create-jiri.projects');
    }

    public function addDuties()
    {
        for ($i = 0; $i < count($this->students); $i++) {
            $this->addDuties = auth()
                ->user()
                ?->duties()
                ->firstOrCreate(
                    [
                        'project_id' => $this->lastProject->id,
                        'jiri_id' => $this->lastJiri->id,
                        'contact_id'=>$this->students[$i]['id'],
                    ],
                    [
                        'contact_id'=>$this->students[$i]['id'],
                        'jiri_id' => $this->lastJiri->id,
                        'project_id' => $this->lastProject->id,
                    ]
                );
        }
    }
}
