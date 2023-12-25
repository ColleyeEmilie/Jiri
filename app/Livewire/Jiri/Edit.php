<?php

namespace App\Livewire\Jiri;

use App\Models\Contact;
use App\Models\Project;
use App\Traits\CreateJiri;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Edit extends Component
{
    use CreateJiri;

    public $tasks = [];
    public $jiri;
    public $jiriName;
    public $jiriDate;

    public function mount($jiri): void
    {
        $this->jiri = $jiri;
    }

    #[Computed]
    public function addedJurys(): Collection|array|_IH_Attendance_C
    {
        return $this->listOfJiriJurys($this->jiri);
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
    #[Computed]
    public function filteredAvailableContacts($jiri_id)
    {
        return auth()->
        user()->
        contacts()
            ->where(function ($q) use ($jiri_id) {
                $q->where('name', 'like', '%' . $this->name . '%')
                    ->whereDoesntHave('attendances', function ($query) use ($jiri_id) {
                        $query->where('jiri_id', $jiri_id);
                    });
            })
            ->get();
    }

    public function enregistrer($attendance): void
    {
        $lastJiriId = $this->jiri->id;

        $implementations = auth()->user()->implementations()->query()
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
    public function editGeneral(): void
    {
        $this->jiri->update([
            'name' => $this->jiriName,
            'date' => $this->jiriDate,
        ]);
    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.jiri.edit');
    }
}
