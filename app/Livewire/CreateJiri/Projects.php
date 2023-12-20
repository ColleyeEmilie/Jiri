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
    public function addedProjects()
    {
        return auth()->user()
            ->projects()
            ->join('duties', 'projects.id', '=', 'duties.project_id')
            ->where('jiri_id', '=', $this->lastJiri->id)
            ->get();
    }
    #[Computed]
    public function addedStudents()
    {
        return $this
            ->lastJiri
            ->attendances()
            ->with('contact')
            ->where('role','student')
            ->get();
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
        $this->addedStudents();
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
        $this->projectId = auth()
            ->user()
            ?->projects()
            ->updateOrCreate([
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
        foreach ($this->addedStudents() as $index => $student){
            foreach ($this->addedProjects() as $index2 => $project){
                 auth()
                    ->user()
                    ->implementations()
                    ->firstOrCreate(
                        [
                            'project_id' => $project->project_id,
                            'jiri_id' => $this->lastJiri->id,
                            'contact_id' => $student->contact->id,
                        ],
                        [
                            'contact_id' => $student->contact->id,
                            'jiri_id' => $this->lastJiri->id,
                            'project_id' => $project->project_id,
                        ]
                    );
            }
        }
    }

    public function deleteProjectFromJiri($project_id, $jiri_id): void
    {
        for ($i = 0; $i < count($this->addedStudents()); $i++) {
            auth()->user()->implementations()
                ->where('project_id', $project_id)
                ->where('jiri_id', $jiri_id)
                ->where('contact_id', $this->addedStudents()[$i])
                ->delete();
        }

        auth()->user()->duties()
            ->where('project_id', $project_id)
            ->where('jiri_id', $jiri_id)
            ->delete();
    }

}
