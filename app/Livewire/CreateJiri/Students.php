<?php

namespace App\Livewire\CreateJiri;

use App\Models\Jiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Students extends Component
{

    public Jiri $lastJiri;
    public $tasks = [];

    #[Computed]
    public function lastJiri(): Jiri
    {
        return Jiri::orderBy('created_at', 'desc')->first();
    }

    #[Computed]
    public function addedStudents(): Collection|array|_IH_Attendance_C
    {
        return $this
            ->lastJiri()
            ->attendances()
            ->with('contact')
            ->where('role', 'student')
            ->get();
    }

    #[Computed]
    public function addedProjects()
    {
        return auth()->user()
            ->projects()
            ->join('duties', 'projects.id', '=', 'duties.project_id')
            ->where('duties.deleted_at', null)
            ->where('jiri_id', '=', $this->lastJiri()->id)
            ->get();
    }

    #[Computed]
    public function checkboxes()
    {
        foreach ($this->addedProjects() as $project) {
            foreach ($this->addedStudents() as $attendance) {
                $this->tasks[$project->project_id . '-' . $attendance['contact_id']]['back'] = true;
                $this->tasks[$project->project_id . '-' . $attendance['contact_id']]['front'] = true;
                $this->tasks[$project->project_id . '-' . $attendance['contact_id']]['design'] = true;
            }
        }
    }

    public function mount()
    {
        $this->checkboxes();
    }

    public function deleteContactRole($contact_id, $jiri_id): void
    {
        auth()->user()->attendances()
            ->where([
                ['contact_id', '=', $contact_id],
                ['jiri_id', '=', $jiri_id]
            ])
            ->delete();
        unset($this->addStudents);
        unset($this->addJurys);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.students');
    }

    public function enregistrer($attendance)
    {
        foreach ($this->addedProjects as $project) {
            $implementation = auth()->user()
                ->implementations()
                ->where('jiri_id', $attendance['jiri_id'])
                ->where('contact_id', $attendance['contact_id'])
                ->where('project_id', $project->project_id)
                ->first();

            if ($implementation) {
                $task = $project->project_id . '-' . $attendance['contact_id'];

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
}
