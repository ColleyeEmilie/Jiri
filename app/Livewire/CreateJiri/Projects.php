<?php

namespace App\Livewire\CreateJiri;

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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
    #[Computed]
    public function addStudents()
    {
        return auth()->user()->contacts()->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->select('contacts.id', 'contacts.name', 'contacts.firstname', 'attendances.role', 'attendances.token', 'attendances.jiri_id', 'attendances.contact_id', 'attendances.deleted_at')
            ->where('role', '=', 'student')
            ->where('attendances.deleted_at', null)
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
    public function mount(): void
    {
        $this->lastJiri();
        $this->addStudents();
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
        $this->addDuties();
        $this->addImplementations();
        $this->reset('infoCurrentProject', 'projectName', 'projectLink', 'projectDescription', 'projectPonderation');
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
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
        foreach ($this->addStudents() as $index => $student){
            foreach ($this->addProjects() as $index2 => $project){
                $this->addImplementations = auth()
                    ->user()
                    ->implementations()
                    ->create(
                        [
                            'project_id' => $this->addProjects()[$index2]['id'],
                            'jiri_id' => $this->lastJiri->id,
                            'contact_id' => $this->addStudents()[$index]['id'],
                        ],
                        [
                            'contact_id' => $this->addStudents()[$index]['id'],
                            'jiri_id' => $this->lastJiri->id,
                            'project_id' => $this->addProjects()[$index2]['id'],
                        ]
                    );
            }
        }
    }

    public function deleteProjectFromJiri($project_id, $jiri_id): void
    {
        for ($i = 0; $i < count($this->addStudents()); $i++) {
            auth()->user()->implementations()
                ->where('project_id', $project_id)
                ->where('jiri_id', $jiri_id)
                ->where('contact_id', $this->addStudents()[$i])
                ->delete();
        }

        auth()->user()->duties()
            ->where('project_id', $project_id)
            ->where('jiri_id', $jiri_id)
            ->delete();
    }

}
