<?php

namespace App\Livewire\CreateJiri;

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

    public $jiri;
    public $tasks = [];

    public function mount($jiri): void
    {
        $this->jiri = $jiri;
    }
    #[Computed]
    public function addedStudents(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriStudents($this->jiri);
    }
    #[Computed]
    public function addedProjects()
    {
        return $this->listOfJiriProjects($this->jiri);
    }

    public function enregistrer($attendance): void
    {
        dd($this->addedProjects()->pluck('project_id'));
        $lastJiriId = $this->jiri->id;
        $implementations = auth()->user()->implementations()
            ->where('jiri_id', $lastJiriId)
            ->whereIn('project_id', $this->addedProjects()->pluck('project_id'))
            ->where('contact_id', $attendance['id'])
            ->get();

        foreach ($implementations as $implementation) {
            $taskKey = $implementation->project_id . '-' . $attendance['id'];

            if (!isset($this->tasks[$taskKey])) {
                $this->tasks[$taskKey] = [
                    'back' => false,
                    'front' => false,
                    'design' => false,
                ];
            }

            $implementation->update([
                'tasks' => json_encode($this->tasks[$taskKey]),
            ]);
        }
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.create-jiri.students');
    }
}
