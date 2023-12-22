<?php

namespace App\Livewire\Jiri;

use App\Models\Contact;
use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public $jiri;
    public $jurys;
    public $students;
    public $projects;

    public function mount($jiri): void
    {
        $this->jiri = $jiri;
        $this->addJurys();
        $this->students();
        $this->projects();

    }

    public function addJurys(): void
    {
        $this->jurys = auth()->user()->contacts()->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('role', '=', 'jury')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function students(): void
    {
        $this->students = auth()->user()->contacts()->join('attendances', 'contacts.id', '=', 'attendances.contact_id')
            ->where('role', '=', 'student')
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function projects(): void
    {
        $this->projects = auth()->user()->projects()->join('duties','projects.id', '=', 'duties.project_id' )
            ->where('jiri_id', '=', $this->jiri->id)
            ->get()->toArray();
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.jiri.show');
    }
}
