<?php

namespace App\Livewire\Jiri;

use App\Models\Contact;
use App\Models\Project;
use App\Traits\CreateJiri;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Attendance_C;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Show extends Component
{
    use CreateJiri;

    public $jiri;

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

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.jiri.show');
    }
}
