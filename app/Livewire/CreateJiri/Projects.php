<?php

namespace App\Livewire\CreateJiri;

use App\Models\Contact;
use App\Models\Duty;
use App\Models\Implementation;
use App\Models\Jiri;
use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Projects extends Component
{
    public $projects;
    public $lastJiri;
    public $lastProject;
    public $students;
    public $addImplementations;
    public $projectName = '';
    public $projectLink = '';
    public $addDuties;
    public $projectPonderation = '';
    public $projectDescription = '';
    public $currentProject = '';
    public $infoCurrentProject;
    public ?int $projectId;

    #[Computed]
    public function filteredAvailableProjects($jiri_id)
    {
        return auth()->
        user()->
        projects()
            ->where(function ($q) use ($jiri_id) {
                $q->where('name', 'like', '%' . $this->projectName . '%')
                    ->whereDoesntHave('duties', function ($query) use ($jiri_id) {
                        $query->where('jiri_id', $jiri_id);
                    });
            })
            ->get();
    }

    public function students(): void
    {
        $this->students = Contact::join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.id', 'contacts.name', 'contacts.firstname', 'contacts.email', 'attendances.role')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }

    #[Computed]
    public function addProjects()
    {
        return auth()->user()->projects()
            ->join('duties', 'projects.id', '=', 'duties.project_id')
            ->select('*')
            ->where('duties.deleted_at', null)
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get()->toArray();
    }

    public function lastJiri(): void
    {
        $this->lastJiri = Jiri::orderBy('created_at', 'desc')->first();
    }

    public function lastProject(): void
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
        $this->students();
        $this->addImplementations();
    }

    public function newProject(): void
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
            ->updateOrCreate([
                'link' => $this->projectLink,
                'name' => $this->projectName,
            ],
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
        $this->addImplementations();
        $this->reset('infoCurrentProject', 'projectName', 'projectLink', 'projectDescription', 'projectPonderation');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.projects');
    }

    public function addDuties(): void
    {
        $this->addDuties = auth()
            ->user()
            ?->duties()
            ->firstOrCreate(
                [
                    'project_id' => $this->lastProject->id,
                    'jiri_id' => $this->lastJiri->id,
                ],
                [
                    'jiri_id' => $this->lastJiri->id,
                    'project_id' => $this->lastProject->id,
                ]
            );
    }

    public function addImplementations(): void
    {
        for ($i = 0; $i < count($this->students); $i++) {
            for ($j = 0; $j < count($this->addProjects()); $j++) {
                $this->addImplementations = auth()
                    ->user()
                    ->implementations()
                    ->firstOrCreate(
                        [
                            'project_id' => $this->addProjects()[$i]['id'],
                            'jiri_id' => $this->lastJiri->id,
                            'contact_id' => $this->students[$i]['id'],
                        ],
                        [
                            'contact_id' => $this->students[$i]['id'],
                            'jiri_id' => $this->lastJiri->id,
                            'project_id' => $this->addProjects()[$i]['id'],
                        ]
                    );
            }
        }
    }

    public function deleteProjectFromJiri($project_id, $jiri_id): void
    {
        for ($i = 0; $i < count($this->students); $i++) {
            auth()->user()->implementations()
                ->where('project_id', $project_id)
                ->where('jiri_id', $jiri_id)
                ->where('contact_id', $this->students[$i])
                ->delete();
        }

        auth()->user()->duties()
            ->where('project_id', $project_id)
            ->where('jiri_id', $jiri_id)
            ->delete();
    }

}
