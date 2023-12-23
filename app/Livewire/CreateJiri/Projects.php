<?php

namespace App\Livewire\CreateJiri;

use App\Traits\CreateJiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Projects extends Component
{
    use CreateJiri;

    public $projects;
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

    public function mount(): void
    {
        $this->getLastJiri();
        $this->addedStudents();
    }

    #[Computed]
    public function getLastJiri()
    {
        return $this->lastJiri();
    }

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
    public function addedProjects()
    {
        return $this->listOfJiriProjects();
    }

    #[Computed]
    public function addedStudents()
    {
        return $this->listOfJiriStudents();
    }

    public function lastProject(): void
    {
        $this->lastProject = auth()->user()
            ->projects()
            ->where('name', '=', $this->projectName)
            ->first();
    }


    public function addDuties(): void
    {
        $this->addDuties = auth()
            ->user()
            ?->duties()
            ->firstOrCreate(
                [
                    'project_id' => $this->lastProject->id,
                    'jiri_id' => $this->getLastJiri()->id,
                ],
                [
                    'jiri_id' => $this->getLastJiri()->id,
                    'project_id' => $this->lastProject->id,
                ]
            );
    }

    public function addImplementations(): void
    {
        foreach ($this->addedStudents() as $index => $student) {
            foreach ($this->addedProjects() as $index2 => $project) {
                auth()
                    ->user()
                    ->implementations()
                    ->firstOrCreate(
                        [
                            'project_id' => $project->id,
                            'jiri_id' => $this->getLastJiri()->id,
                            'contact_id' => $student->id,
                        ],
                        [
                            'contact_id' => $student->id,
                            'jiri_id' => $this->getLastJiri()->id,
                            'project_id' => $project->id,
                        ]
                    );
            }
        }
    }

    public function newProject(): void
    {
        if ($this->projectName === '') {
            $this->infoCurrentProject = preg_split('/[,:;]+/', $this->currentProject);
            $this->projectName = $this->infoCurrentProject[0];
            $this->projectLink = $this->infoCurrentProject[1];
            $this->projectPonderation = $this->infoCurrentProject[2];
            $this->projectDescription = $this->infoCurrentProject[3];
        }

        $project = auth()->user()->projects()
            ->updateOrCreate(
                ['name' => $this->projectName],
                [
                    'name' => $this->projectName,
                    'link' => $this->projectLink,
                    'ponderation' => $this->projectPonderation,
                    'description' => $this->projectDescription,
                ]
            );

        $this->projectId = $project->id;

        $this->getLastJiri();
        $this->lastProject();
        $this->addDuties();
        $this->addImplementations();

        $this->reset('infoCurrentProject', 'projectName', 'projectLink', 'projectDescription', 'projectPonderation');
    }

    public function deleteProjectFromJiri($project_id, $jiri_id): void
    {
        $studentIds = $this->addedStudents()->pluck('id')->toArray();

        auth()->user()->implementations()
            ->whereIn('contact_id', $studentIds)
            ->where('project_id', $project_id)
            ->where('jiri_id', $jiri_id)
            ->delete();

        auth()->user()->duties()
            ->where('project_id', $project_id)
            ->where('jiri_id', $jiri_id)
            ->delete();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.projects');
    }
}
