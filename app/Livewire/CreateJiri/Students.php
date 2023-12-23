<?php

namespace App\Livewire\CreateJiri;

use App\Models\Jiri;
use App\Traits\CreateJiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Students extends Component
{
    use CreateJiri;

    public $tasks = [];

    #[Computed]
    public function getLastJiri()
    {
        return $this->lastJiri();
    }
    #[Computed]
    public function addedStudents(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriStudents();
    }
    #[Computed]
    public function addedProjects()
    {
        return $this->listOfJiriProjects();
    }

    public function enregistrer($attendance): void
    {
        foreach ($this->addedProjects() as $project) {
            $implementation = auth()->user()
                ->implementations()
                ->where('jiri_id', $this->getLastJiri()->id)
                ->where('contact_id', $attendance['id'])
                ->where('project_id', $project->project_id)
                ->first();

            if ($implementation) {
                $task = $project->project_id . '-' . $attendance['id'];

                if (!array_key_exists($task, $this->tasks)) {
                    $this->tasks[$task] = [
                        'back' => false,
                        'front' => false,
                        'design' => false,
                    ];
                } else {
                    $this->tasks[$task]['back'] = $this->tasks[$task]['back'] ?? false;
                    $this->tasks[$task]['front'] = $this->tasks[$task]['front'] ?? false;
                    $this->tasks[$task]['design'] = $this->tasks[$task]['design'] ?? false;
                }
                $implementation->update([
                    'tasks' => json_encode($this->tasks[$task]),
                ]);
            }
        }
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.students');
    }
}
